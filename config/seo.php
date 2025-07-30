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
            'description' => 'Tải miễn phí hàng nghìn đề thi, tài liệu ôn thi chuyển cấp vào lớp 1, 6, 10. Thông tin tuyển sinh các trường top đầu. Thông tin các trung tâm, giáo viên uy tín.',
            'keywords' => 'ôn thi chuyển cấp, đề thi vào lớp 6, đề thi vào lớp 10, LT365',
        ],

        // === ROUTE: exam.* ===
        'exam.index' => [
            'title' => 'Thi chuyển cấp - Hướng dẫn ôn thi vào lớp 1, 6, 10 | LT365',
            'description' => 'Tổng hợp kinh nghiệm, chiến lược ôn thi chuyển cấp hiệu quả. Lịch thi, đề thi mẫu.',
        ],
        'exam.grade1' => [
            'title' => 'Ôn thi vào lớp 1 - {total_documents} tài liệu, đề thi mẫu miễn phí | LT365',
            'description' => 'Chuẩn bị thi vào lớp 1 với {total_documents} tài liệu, đề thi mẫu từ các trường uy tín.',
        ],
        'exam.grade6' => [
            'title' => 'Ôn thi vào lớp 6 - {total_documents} tài liệu, đề thi chuyên miễn phí | LT365',
            'description' => 'Tổng hợp {total_documents} tài liệu, đề thi vào lớp 6 các trường THCS chuyên.',
        ],
        'exam.grade10' => [
            'title' => 'Ôn thi vào lớp 10 - {total_documents} tài liệu, đề thi THPT miễn phí | LT365',
            'description' => 'Kho tài liệu ôn thi vào lớp 10 với {total_documents} tài liệu, đề thi THPT.',
        ],

        // === ROUTE: documents.* ===
        'documents.index' => [
            'title' => 'Tài liệu, đề thi, bài tập, bài giảng, ... ôn thi chuyển cấp miễn phí | LT365',
            'description' => 'Tải miễn phí hàng nghìn tài liệu, đề thi, bài tập, bài giảng, ... ôn thi chuyển cấp vào lớp 1, 6, 10 từ các trường top đầu.',
        ],
        'documents.by-type' => [
            'title' => '{document_type_name} - Ôn thi chuyển cấp | LT365',
            'description' => 'Danh sách {document_type_name} ôn thi chuyển cấp. Tải miễn phí tài liệu, đề thi, bài tập, bài giảng, ...',
        ],
        'documents.by-level' => [
            'title' => 'Tài liệu, đề thi, bài tập, bài giảng {level_name} | LT365',
            'description' => 'Tổng hợp tài liệu, đề thi, bài tập, bài giảng {level_name} các môn.',
        ],
        'documents.by-subject' => [
            'title' => 'Tài liệu, đề thi, bài tập, bài giảng môn {subject_name} | LT365',
            'description' => 'Tổng hợp tài liệu và đề thi ôn thi chuyển cấp môn {subject_name}.',
        ],
        'documents.by-level-subject' => [
            'title' => 'Tài liệu, đề thi, bài tập, bài giảng môn {subject_name} {level_name} | LT365',
            'description' => 'Tổng hợp tài liệu, đề thi, bài tập, bài giảng, ... ôn thi chuyển cấp môn {subject_name} {level_name}.',
        ],
        'documents.by-type-level' => [
            'title' => '{document_type_name} {level_name} | LT365',
            'description' => 'Danh sách {document_type_name} ôn thi {level_name} chi tiết.',
        ],
        'documents.by-type-subject' => [
            'title' => '{document_type_name} môn {subject_name} | LT365',
            'description' => 'Danh sách {document_type_name} ôn thi chuyển cấp môn {subject_name}.',
        ],
        'documents.by-all' => [
            'title' => '{document_type_name} môn {subject_name} {level_name} | LT365',
            'description' => 'Danh sách {document_type_name} môn {subject_name} {level_name}. Tải miễn phí {document_type_name} tại LT365.',
        ],
        'documents.show' => [
            'title' => '{name} - Đề thi {subject} lớp {level} | LT365',
            'description' => 'Tải miễn phí {name}. Đề thi {subject} lớp {level} từ {school_name} năm {year}.',
        ],

        // === ROUTE: schools.* ===
        'schools.index' => [
            'title' => 'Danh sách trường học tại Việt Nam - Tuyển sinh {current_year} | LT365',
            'description' => 'Cập nhật thông tin tuyển sinh, điểm chuẩn, học phí năm {current_year} của các trường học trên cả nước.',
        ],
        'schools.by-level' => [
            'title' => 'Danh sách trường {level_name} - Tuyển sinh {current_year} | LT365',
            'description' => 'Danh sách các trường {level_name} trên cả nước và thông tin tuyển sinh năm {current_year}.',
        ],
        'schools.by-province' => [
            'title' => 'Danh sách trường học tại {province_name} - Tuyển sinh {current_year} | LT365',
            'description' => 'Danh sách các trường học tại {province_name} và thông tin tuyển sinh năm {current_year}.',
        ],
        'schools.by-type' => [
            'title' => 'Danh sách trường {school_type_name} - Tuyển sinh {current_year} | LT365',
            'description' => 'Danh sách các trường {school_type_name} trên cả nước và thông tin tuyển sinh năm {current_year}.',
        ],
        'schools.by-level-province' => [
            'title' => 'Danh sách trường {level_name} tại {province_name} | LT365',
            'description' => 'Danh sách các trường {level_name} tại {province_name} và thông tin tuyển sinh năm {current_year}.',
        ],
        'schools.by-level-type' => [
            'title' => 'Danh sách trường {level_name} {school_type_name} | LT365',
            'description' => 'Danh sách các trường {level_name} {school_type_name} và thông tin tuyển sinh năm {current_year}.',
        ],
        'schools.by-province-type' => [
            'title' => 'Danh sách trường {school_type_name} tại {province_name} | LT365',
            'description' => 'Danh sách các trường {school_type_name} tại {province_name} và thông tin tuyển sinh năm {current_year}.',
        ],
        'schools.by-all' => [
            'title' => 'Danh sách trường {level_name} {school_type_name} tại {province_name} | LT365',
            'description' => 'Danh sách các trường {level_name} {school_type_name} tại {province_name} và thông tin tuyển sinh năm {current_year}.',
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
        'news.by-category' => [
            'title' => 'Tin tức {category_name} - {total_news} bài viết | LT365',
            'description' => 'Tổng hợp {total_news} tin tức {category_name} mới nhất từ các nguồn uy tín.',
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

        // === ROUTE: contact ===
        'contact.index' => [
            'title' => 'Liên hệ - LT365',
            'description' => 'Liên hệ với chúng tôi để được hỗ trợ và giải đáp thắc mắc.',
        ],

        // === ROUTE: auth ===
        'login' => [
            'title' => 'Đăng nhập - LT365',
            'description' => 'Đăng nhập vào tài khoản của bạn để truy cập các tính năng độc quyền.',
        ],
        'register.show' => [
            'title' => 'Đăng ký - LT365',
            'description' => 'Tạo tài khoản mới để tham gia cộng đồng và tải tài liệu.',
        ],
        'password.request' => [
            'title' => 'Quên mật khẩu - LT365',
            'description' => 'Yêu cầu đặt lại mật khẩu cho tài khoản của bạn.',
        ],
        'password.reset' => [
            'title' => 'Đặt lại mật khẩu - LT365',
            'description' => 'Tạo mật khẩu mới cho tài khoản của bạn.',
        ],
        'verify.notice' => [
            'title' => 'Xác thực Email - LT365',
            'description' => 'Vui lòng kiểm tra email và xác thực tài khoản của bạn.',
        ],

        // === ROUTE: user dashboard ===
        'user.dashboard' => [
            'title' => 'Bảng điều khiển - LT365',
            'description' => 'Quản lý thông tin cá nhân và hoạt động của bạn trên LT365.',
        ],
        'user.profile' => [
            'title' => 'Hồ sơ cá nhân - LT365',
            'description' => 'Cập nhật thông tin cá nhân của bạn.',
        ],
        'user.downloads' => [
            'title' => 'Tài liệu đã tải - LT365',
            'description' => 'Danh sách các tài liệu bạn đã tải xuống.',
        ],
        'user.favorites' => [
            'title' => 'Danh sách yêu thích - LT365',
            'description' => 'Quản lý danh sách các nội dung bạn đã yêu thích.',
        ],
        'user.change-password' => [
            'title' => 'Đổi mật khẩu - LT365',
            'description' => 'Thay đổi mật khẩu tài khoản của bạn.',
        ],

        // === ROUTE: static pages ===
        'page.show' => [
            'title' => '{name} | LT365',
            'description' => 'Thông tin về {name} tại LT365.',
        ],
    ],

    'variables' => [
        'site_name' => 'LT365',
        'current_year' => date('Y'),
        'academic_year' => (date('n') >= 8) ? date('Y') . '-' . (date('Y') + 1) : (date('Y') - 1) . '-' . date('Y'),
    ]
];
