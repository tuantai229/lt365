<?php
return [
    'default' => [
        'site_name' => 'LT365',
        'separator' => ' | ',
        'meta_robots' => 'index,follow',
        'og_type' => 'website',
        'og_locale' => 'vi_VN',
    ],

    'templates' => [
        // === ROUTE: home ===
        'home' => [
            'title' => 'LT365 - Website ôn thi chuyển cấp hàng đầu Việt Nam',
            'description' => 'Tải miễn phí hàng nghìn đề thi, tài liệu ôn thi vào lớp 1, 6, 10. Thông tin tuyển sinh các trường top đầu.',
            'keywords' => 'ôn thi chuyển cấp, đề thi vào lớp 1, đề thi vào lớp 6, đề thi vào lớp 10, LT365',
        ],

        // === ROUTE: exam.* ===
        'exam.index' => [
            'title' => 'Thi chuyển cấp - Hướng dẫn ôn thi vào lớp 1, 6, 10 | LT365',
            'description' => 'Tổng hợp kinh nghiệm, chiến lược ôn thi chuyển cấp hiệu quả. Lịch thi, đề thi mẫu.',
        ],
        'exam.grade1' => [
            'title' => 'Ôn thi vào lớp 1 - {total_documents} đề thi mẫu miễn phí | LT365',
            'description' => 'Chuẩn bị thi vào lớp 1 với {total_documents} đề thi mẫu từ các trường uy tín.',
        ],
        'exam.grade6' => [
            'title' => 'Ôn thi vào lớp 6 - {total_documents} đề thi chuyên miễn phí | LT365',
            'description' => 'Tổng hợp {total_documents} đề thi vào lớp 6 các trường THCS chuyên.',
        ],
        'exam.grade10' => [
            'title' => 'Ôn thi vào lớp 10 - {total_documents} đề thi THPT miễn phí | LT365',
            'description' => 'Kho tài liệu ôn thi vào lớp 10 với {total_documents} đề thi THPT.',
        ],

        // === ROUTE: documents.* ===
        'documents.index' => [
            'title' => 'Tài liệu ôn thi - {total_documents} đề thi miễn phí | LT365',
            'description' => 'Tải miễn phí {total_documents} tài liệu ôn thi chuyển cấp từ các trường top đầu.',
        ],
        'documents.category' => [
            'title' => 'Đề thi {subject} lớp {level} - {total_documents} tài liệu | LT365',
            'description' => 'Tổng hợp {total_documents} đề thi {subject} lớp {level} có lời giải chi tiết.',
        ],
        'documents.show' => [
            'title' => '{name} - Đề thi {subject} lớp {level} | LT365',
            'description' => 'Tải miễn phí {name}. Đề thi {subject} lớp {level} từ {school_name} năm {year}.',
        ],

        // === ROUTE: schools.* ===
        'schools.index' => [
            'title' => 'Thông tin {total_schools} trường học - Tuyển sinh {current_year} | LT365',
            'description' => 'Cập nhật thông tin tuyển sinh {current_year} của {total_schools} trường học.',
        ],
        'schools.category' => [
            'title' => 'Trường {level} tại {province} - {total_schools} trường | LT365',
            'description' => 'Danh sách {total_schools} trường {level} tại {province}. Thông tin tuyển sinh {current_year}.',
        ],
        'schools.show' => [
            'title' => 'Trường {name} - {province} | Tuyển sinh {current_year} | LT365',
            'description' => 'Thông tin trường {name} tại {province}. Điểm chuẩn, học phí năm {current_year}.',
        ],

        // === ROUTE: news.* ===
        'news.index' => [
            'title' => 'Tin tức giáo dục - Cập nhật chính sách tuyển sinh | LT365',
            'description' => 'Tin tức giáo dục mới nhất về chính sách tuyển sinh, lịch thi, thông báo trường học.',
        ],
        'news.category' => [
            'title' => 'Tin tức {category} - {total_news} bài viết | LT365',
            'description' => 'Tổng hợp {total_news} tin tức {category} mới nhất từ các nguồn uy tín.',
        ],
        'news.show' => [
            'title' => '{name} | LT365',
            'description' => '{excerpt}',
        ],

        // === ROUTE: teachers.* ===
        'teachers.index' => [
            'title' => 'Danh sách {total_teachers} giáo viên uy tín | LT365',
            'description' => 'Kết nối với {total_teachers} giáo viên có kinh nghiệm.',
        ],
        'teachers.show' => [
            'title' => 'Thầy/Cô {name} - Giáo viên {subjects} | LT365',
            'description' => 'Giáo viên {name}, chuyên dạy {subjects}. {experience} năm kinh nghiệm tại {province}.',
        ],

        // === ROUTE: centers.* ===
        'centers.index' => [
            'title' => 'Danh sách {total_centers} trung tâm dạy học uy tín | LT365',
            'description' => 'Tìm kiếm {total_centers} trung tâm dạy học chất lượng.',
        ],
        'centers.show' => [
            'title' => 'Trung tâm {name} - {province} | LT365',
            'description' => 'Trung tâm {name} tại {province}. {experience} năm kinh nghiệm.',
        ],

        // === ROUTE: search ===
        'search' => [
            'title' => 'Tìm kiếm "{query}" - {total_results} kết quả | LT365',
            'description' => 'Kết quả tìm kiếm cho "{query}". Tìm thấy {total_results} kết quả phù hợp.',
        ],
    ],

    'variables' => [
        'site_name' => 'LT365',
        'current_year' => date('Y'),
        'academic_year' => (date('n') >= 8) ? date('Y') . '-' . (date('Y') + 1) : (date('Y') - 1) . '-' . date('Y'),
    ]
];
