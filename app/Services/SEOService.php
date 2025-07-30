<?php
namespace App\Services;

use App\Models\MetaSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SEOService
{
    protected array $seoConfig;
    protected array $defaultConfig;

    public function __construct()
    {
        $this->seoConfig = config('seo.templates', []);
        $this->defaultConfig = config('seo.default', []);
    }

    public function generateSeoData(string $routeName, Model $model = null, array $additionalData = []): array
    {
        $customMeta = $model ? $this->getCustomMeta($model) : null;
        $template = $this->getTemplate($routeName);
        $variables = $this->prepareVariables($model, $additionalData);
        
        return [
            'meta_title' => $this->generateMetaTitle($customMeta, $template, $variables),
            'meta_description' => $this->generateMetaDescription($customMeta, $template, $variables),
            'meta_keywords' => $this->generateMetaKeywords($customMeta, $template, $variables),
            'meta_robots' => $customMeta?->meta_robots ?? $this->defaultConfig['meta_robots'],
            'og_image' => $this->getOgImage($customMeta, $model),
            'og_type' => $this->defaultConfig['og_type'],
            'og_locale' => $this->defaultConfig['og_locale'],
            'canonical_url' => request()->url(),
        ];
    }

    protected function getCustomMeta(Model $model): ?MetaSeo
    {
        return $model->metaSeo ?? null;
    }

    protected function getTemplate(string $routeName): array
    {
        return $this->seoConfig[$routeName] ?? [];
    }

    protected function prepareVariables(Model $model = null, array $additionalData = []): array
    {
        $variables = array_merge(config('seo.variables', []), $additionalData);
        
        if ($model) {
            $variables = array_merge($variables, $this->extractModelVariables($model));
        }
        
        return $variables;
    }

    protected function extractModelVariables(Model $model): array
    {
        $variables = [];
        $attributes = $model->getAttributes();

        // Basic attributes
        foreach (['name', 'title', 'slug'] as $attr) {
            if (isset($attributes[$attr])) {
                $variables[$attr] = $attributes[$attr];
            }
        }

        // Model-specific variables
        $modelClass = class_basename($model);
        $methodName = 'extract' . $modelClass . 'Variables';
        
        if (method_exists($this, $methodName)) {
            $variables = array_merge($variables, $this->$methodName($model));
        }

        return $variables;
    }

    // Extract methods cho từng model
    protected function extractDocumentVariables($document): array
    {
        return [
            'subject' => $document->subject?->name,
            'level' => $document->level?->name,
            'school_name' => $document->school?->name,
            'year' => $document->year,
        ];
    }

    protected function extractSchoolVariables($school): array
    {
        return [
            'province' => $school->province?->name,
            'level' => $school->level?->name,
        ];
    }

    protected function extractNewsVariables($news): array
    {
        return [
            'excerpt' => Str::limit(strip_tags($news->content), 150),
            'category' => $news->category?->name,
        ];
    }

    protected function extractTeacherVariables($teacher): array
    {
        return [
            'subjects' => $teacher->subjects?->pluck('name')->join(', '),
            'experience' => $teacher->experience,
            'province' => $teacher->province?->name,
        ];
    }

    protected function extractCenterVariables($center): array
    {
        return [
            'subjects' => $center->subjects?->pluck('name')->join(', '),
            'experience' => $center->experience,
            'province' => $center->province?->name,
        ];
    }

    protected function generateMetaTitle(?MetaSeo $customMeta, array $template, array $variables): string
    {
        if ($customMeta && $customMeta->meta_title) {
            return $this->processTemplate($customMeta->meta_title, $variables);
        }

        if (isset($template['title'])) {
            return $this->processTemplate($template['title'], $variables);
        }

        return ($variables['name'] ?? 'Trang') . $this->defaultConfig['separator'] . $this->defaultConfig['site_name'];
    }

    protected function generateMetaDescription(?MetaSeo $customMeta, array $template, array $variables): string
    {
        if ($customMeta && $customMeta->meta_description) {
            return $this->processTemplate($customMeta->meta_description, $variables);
        }

        if (isset($template['description'])) {
            return $this->processTemplate($template['description'], $variables);
        }

        return 'Thông tin chi tiết về ' . ($variables['name'] ?? 'nội dung') . ' tại LT365.';
    }

    protected function generateMetaKeywords(?MetaSeo $customMeta, array $template, array $variables): string
    {
        if ($customMeta && $customMeta->meta_keywords) {
            return $customMeta->meta_keywords;
        }

        if (isset($template['keywords'])) {
            return $this->processTemplate($template['keywords'], $variables);
        }

        return '';
    }

    protected function getOgImage(?MetaSeo $customMeta, ?Model $model): ?string
    {
        if ($customMeta && $customMeta->og_image_id) {
            // Return custom OG image URL
        }

        if ($model && method_exists($model, 'featuredImage') && $model->featuredImage) {
            // Return model featured image URL
        }

        return config('app.url') . '/images/og-default.jpg';
    }

    protected function processTemplate(string $template, array $variables): string
    {
        foreach ($variables as $key => $value) {
            if (is_scalar($value)) {
                $template = str_replace('{' . $key . '}', $value, $template);
            }
        }

        return trim(preg_replace('/\s+/', ' ', preg_replace('/\{[^}]+\}/', '', $template)));
    }
}
