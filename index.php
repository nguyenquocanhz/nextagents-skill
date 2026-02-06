<!DOCTYPE html>
<html lang="vi" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextAgents Skill - Cộng đồng Agent Skill</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <!-- Import Font Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Import Fira Code for Code Blocks -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

    <!-- Supabase JS SDK -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

    <!-- Marked JS (Markdown Parser) -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind CSS (Production Build) -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-p-white text-p-dark dark:bg-p-dark dark:text-p-white min-h-screen flex flex-col">

    <!-- Header -->
    <header
        class="sticky top-0 z-40 bg-p-white/90 dark:bg-p-dark/90 backdrop-blur-md border-b border-border-light dark:border-p-dark-gray transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-s-4 md:px-s-10 py-s-6 flex justify-between items-center">
            <div class="flex items-center gap-s-3 cursor-pointer" onclick="window.location.reload()">
                <div
                    class="w-10 h-10 bg-primary rounded-r-3 flex items-center justify-center text-white shadow-lg shadow-primary/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8V4H8" />
                        <rect width="16" height="12" x="4" y="8" rx="2" />
                        <path d="M2 14h2" />
                        <path d="M20 14h2" />
                        <path d="M15 13v2" />
                        <path d="M9 13v2" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-heading-1 text-primary tracking-wide uppercase">Nencer Agent Hub</h1>
                    <p class="text-xs text-p-grey dark:text-gray-400">Workflow Skills Library</p>
                </div>
            </div>

            <div class="flex items-center gap-s-6">
                <button id="theme-toggle"
                    class="p-s-3 rounded-r-6 hover:bg-border-light dark:hover:bg-p-dark-gray transition-all text-primary">
                    <!-- Sun Icon (Light Mode) -->
                    <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden lucide lucide-sun">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </svg>
                    <!-- Moon Icon (Dark Mode) -->
                    <svg id="theme-toggle-dark-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden lucide lucide-moon">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </svg>
                </button>

                <!-- Auth Section (Dynamic) -->
                <div id="auth-section" class="flex items-center gap-4">
                    <!-- Guest View -->
                    <button onclick="toggleModal('login-modal')" id="btn-login"
                        class="flex items-center gap-2 bg-p-dark dark:bg-p-white text-white dark:text-p-dark px-s-6 py-s-2 rounded-r-3 transition-colors hover:opacity-90 font-bold shadow-md">
                        Đăng nhập
                    </button>

                    <!-- User View (Hidden by default) -->
                    <div id="user-view" class="hidden flex items-center gap-3">
                        <button onclick="toggleModal('upload-modal')"
                            class="hidden md:flex items-center gap-2 bg-primary hover:bg-[#085a96] text-white px-s-6 py-s-2 rounded-r-3 transition-colors shadow-lg shadow-primary/30 active:scale-95 transform duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" x2="12" y1="3" y2="15" />
                            </svg>
                            <span class="text-sm font-bold">Upload</span>
                        </button>
                        <div class="relative group">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-purple-500 to-pink-500 p-0.5 cursor-pointer">
                                <div
                                    class="w-full h-full rounded-full bg-white dark:bg-p-dark flex items-center justify-center overflow-hidden">
                                    <span id="user-avatar-initial" class="font-bold text-primary">U</span>
                                    <img id="user-avatar-img" src="" alt="Avatar"
                                        class="w-full h-full object-cover hidden">
                                </div>
                            </div>
                            <!-- Dropdown with padding-top to bridge the gap -->
                            <div
                                class="absolute right-0 pt-2 w-48 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div
                                    class="bg-white dark:bg-p-dark rounded-r-3 shadow-xl border border-border-light dark:border-p-dark-gray">
                                    <div class="px-4 py-3 border-b border-border-light dark:border-p-dark-gray">
                                        <p class="text-xs text-p-grey">Signed in as</p>
                                        <p id="user-email-display"
                                            class="text-sm font-bold truncate text-p-dark dark:text-p-white">
                                            user@example.com</p>
                                    </div>
                                    <button onclick="openMySkills()"
                                        class="w-full text-left px-4 py-2 text-sm text-p-dark dark:text-p-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                            <path d="M2 17l10 5 10-5"></path>
                                            <path d="M2 12l10 5 10-5"></path>
                                        </svg>
                                        My Skills
                                    </button>
                                    <button onclick="handleLogout()"
                                        class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors rounded-b-r-3">Đăng
                                        xuất</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-s-4 md:px-s-10 py-s-11 w-full">
        <!-- Search & Filter -->
        <div class="mb-s-12 flex flex-col md:flex-row gap-s-6 justify-between items-end md:items-center">
            <div class="w-full md:w-1/2">
                <h2 class="text-heading-lg mb-s-2 text-p-dark dark:text-p-white">Khám phá Workflows</h2>
                <p class="text-p-grey text-sm">Kho lưu trữ các skill AI được đóng gói sẵn sàng sử dụng.</p>
                <!-- Status Indicator -->
                <div id="db-status" class="text-xs mt-2 text-yellow-600 dark:text-yellow-400 hidden">⚠️ Đang chạy chế độ
                    Mock Data</div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="relative w-full group">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm skill (VD: SEO, Marketing...)"
                        class="w-full bg-white dark:bg-p-dark border border-border-light dark:border-p-dark-gray text-p-dark dark:text-p-white px-s-6 py-s-3 rounded-r-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all shadow-sm">
                    <button id="searchBtn"
                        class="absolute right-3 top-2.5 p-1 text-p-grey hover:text-primary transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tags -->
        <div class="flex gap-s-3 overflow-x-auto pb-s-6 mb-s-6 scrollbar-hide" id="category-filters"></div>
        <!-- Result Info -->
        <div class="flex justify-between items-center mb-6 px-1">
            <span id="result-count" class="text-xs text-p-grey font-semibold">Đang tải dữ liệu...</span>
            <div class="flex items-center gap-4">
                <!-- View Toggle -->
                <div class="flex items-center gap-1 bg-gray-100 dark:bg-gray-800 rounded-r-3 p-1">
                    <button id="btn-grid-view" onclick="setViewMode('grid')"
                        class="p-2 rounded-r-2 bg-white dark:bg-p-dark shadow-sm text-primary transition-all"
                        title="Grid View">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-layout-grid">
                            <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                            <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                            <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                            <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                        </svg>
                    </button>
                    <button id="btn-list-view" onclick="setViewMode('list')"
                        class="p-2 rounded-r-2 text-p-grey hover:text-primary transition-all" title="List View">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-list">
                            <line x1="8" x2="21" y1="6" y2="6"></line>
                            <line x1="8" x2="21" y1="12" y2="12"></line>
                            <line x1="8" x2="21" y1="18" y2="18"></line>
                            <line x1="3" x2="3.01" y1="6" y2="6"></line>
                            <line x1="3" x2="3.01" y1="12" y2="12"></line>
                            <line x1="3" x2="3.01" y1="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <!-- Sort -->
                <div class="flex items-center gap-2 text-xs text-p-grey">
                    <span>Sắp xếp:</span>
                    <select
                        class="bg-transparent border-none focus:ring-0 text-p-dark dark:text-p-white font-semibold cursor-pointer">
                        <option>Mới nhất</option>
                        <option>Phổ biến nhất</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Grid -->
        <div id="skills-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-s-10 min-h-[400px]"></div>
        <!-- Pagination -->
        <div id="pagination-container" class="mt-s-16 flex justify-center items-center gap-2"></div>
    </main>

    <!-- Footer -->
    <footer
        class="bg-footer-bg dark:bg-footer-dark border-t border-border-light dark:border-p-dark-gray pt-s-16 pb-s-8 mt-s-16">
        <div class="max-w-7xl mx-auto px-s-4 md:px-s-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-10">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-s-3 mb-4">
                        <div class="w-8 h-8 bg-primary rounded-r-3 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 8V4H8" />
                                <rect width="16" height="12" x="4" y="8" rx="2" />
                                <path d="M2 14h2" />
                                <path d="M20 14h2" />
                                <path d="M15 13v2" />
                                <path d="M9 13v2" />
                            </svg>
                        </div>
                        <span class="text-heading-1 text-primary tracking-wide">NENCER AGENT HUB</span>
                    </div>
                    <p class="text-p-grey text-sm mb-6 leading-relaxed max-w-sm">Nền tảng chia sẻ Workflow Agent Skill
                        hàng đầu. </p>
                </div>
                <div>
                    <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-4">Sản phẩm</h4>
                    <ul class="space-y-3 text-sm text-p-grey">
                        <li><a href="#" class="hover:text-primary">Agent SDK</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-4">Tài nguyên</h4>
                    <ul class="space-y-3 text-sm text-p-grey">
                        <li><a href="#" class="hover:text-primary">API Docs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-4">Công ty</h4>
                    <ul class="space-y-3 text-sm text-p-grey">
                        <li><a href="#" class="hover:text-primary">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="pt-8 border-t border-border-light dark:border-p-dark-gray flex flex-col md:flex-row justify-between items-center text-sm text-p-grey">
                <p>&copy; 2026 Nencer Agent Hub. Powered by Supabase.</p>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast"
        class="fixed bottom-5 left-1/2 -translate-x-1/2 md:left-auto md:translate-x-0 md:right-5 z-[9999] bg-p-dark dark:bg-p-white text-white dark:text-p-dark px-6 py-3 rounded-r-3 shadow-xl flex items-center gap-3 transform translate-y-[200%] opacity-0 transition-all duration-300 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-check-circle text-green-500">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <path d="m9 11 3 3L22 4"></path>
        </svg>
        <span id="toast-message" class="font-medium text-sm">Thành công!</span>
    </div>

    <!-- Login Modal -->
    <div id="login-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleModal('login-modal')"></div>
        <div
            class="relative bg-white dark:bg-p-dark w-full max-w-md mx-4 rounded-r-5 shadow-modal border border-border-light dark:border-p-dark-gray p-s-8">
            <div class="text-center mb-6">
                <h3 class="text-heading-lg text-primary mb-2">Chào mừng trở lại!</h3>
                <p class="text-sm text-p-grey">Đăng nhập để chia sẻ skill của bạn.</p>
            </div>

            <div class="space-y-4">
                <!-- GitHub Button -->
                <button onclick="handleLogin('github')"
                    class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-border-light dark:border-p-dark-gray rounded-r-3 hover:opacity-90 transition-all bg-[#24292e] text-white font-semibold shadow-md">
                    <svg height="20" width="20" viewBox="0 0 16 16" fill="currentColor">
                        <path
                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z">
                        </path>
                    </svg>
                    Đăng nhập bằng GitHub
                </button>

                <button onclick="handleLogin('mock')"
                    class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-dashed border-p-grey rounded-r-3 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-p-grey font-medium text-sm">
                    Mock Login (Chế độ Test)
                </button>
            </div>

            <div class="mt-6 text-center">
                <button onclick="toggleModal('login-modal')"
                    class="text-sm text-p-grey hover:text-primary">Đóng</button>
            </div>
        </div>
    </div>

    <!-- Modal Upload Skill -->
    <div id="upload-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleModal('upload-modal')"></div>
        <div
            class="relative bg-white dark:bg-p-dark w-full max-w-lg mx-4 rounded-r-5 shadow-modal border border-border-light dark:border-p-dark-gray p-s-8 overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-heading-lg text-primary">Upload New Skill</h3>
                <button onclick="toggleModal('upload-modal')"
                    class="text-p-grey hover:text-p-dark dark:hover:text-p-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form id="uploadForm" class="space-y-4">
                <div><label class="block text-sm font-semibold mb-1 text-p-dark dark:text-p-white">Tên
                        Skill</label><input required id="up_title" type="text" placeholder="VD: Marketing Pro"
                        class="w-full px-4 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray bg-transparent dark:text-white focus:border-primary focus:outline-none">
                </div>
                <div><label class="block text-sm font-semibold mb-1 text-p-dark dark:text-p-white">Mô tả
                        ngắn</label><textarea required id="up_desc" rows="4"
                        placeholder="Mô tả workflow của bạn... (Hỗ trợ Markdown)"
                        class="w-full px-4 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray bg-transparent dark:text-white focus:border-primary focus:outline-none font-mono text-sm"></textarea>
                    <p class="text-xs text-p-grey mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        Hỗ trợ <strong>Markdown</strong>: **bold**, *italic*, `code`, ## heading, - list
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-semibold mb-1 text-p-dark dark:text-p-white">Category</label>
                        <select id="up_category"
                            class="w-full px-4 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray bg-transparent dark:text-white focus:border-primary focus:outline-none">
                            <option value="Marketing">Marketing</option>
                            <option value="Coding">Coding</option>
                            <option value="Data Analysis">Data Analysis</option>
                            <option value="Support">Support</option>
                            <option value="HR">HR</option>
                        </select>
                    </div>
                    <!-- Author will be auto-filled or editable -->
                    <div><label class="block text-sm font-semibold mb-1 text-p-dark dark:text-p-white">Tác
                            giả</label><input required id="up_author" type="text"
                            class="w-full px-4 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray bg-transparent dark:text-white focus:border-primary focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1 text-p-dark dark:text-p-white">Link GitHub</label>
                    <input id="up_link_git" type="url" placeholder="https://github.com/username/repo"
                        class="w-full px-4 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray bg-transparent dark:text-white focus:border-primary focus:outline-none">
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="toggleModal('upload-modal')"
                        class="px-6 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Hủy</button>
                    <button type="submit" id="btn-submit-upload"
                        class="px-6 py-2 rounded-r-3 bg-primary text-white hover:bg-[#085a96] transition-colors">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Skill (Same as before) -->
    <div id="detail-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleModal('detail-modal')"></div>
        <div
            class="relative bg-white dark:bg-p-dark w-full max-w-2xl mx-4 rounded-r-5 shadow-modal border border-border-light dark:border-p-dark-gray overflow-hidden flex flex-col max-h-[90vh]">
            <div
                class="p-s-8 border-b border-border-light dark:border-p-dark-gray bg-gray-50 dark:bg-gray-800/50 flex justify-between items-start">
                <div class="flex gap-4">
                    <div id="detail-icon" class="w-16 h-16 rounded-r-4 flex items-center justify-center"></div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h3 id="detail-title" class="text-heading-lg text-p-dark dark:text-p-white"></h3>
                            <span id="detail-version" class="px-2 py-0.5 text-xs font-bold rounded"></span>
                        </div>
                        <p id="detail-author" class="text-sm text-p-grey mb-2"></p>
                        <div id="detail-tags" class="flex gap-2"></div>
                    </div>
                </div>
                <button onclick="toggleModal('detail-modal')"
                    class="text-p-grey hover:text-p-dark dark:hover:text-p-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="p-s-8 overflow-y-auto flex-1">
                <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-2">Mô tả</h4>
                <div id="detail-desc" class="markdown-body text-p-grey text-sm leading-relaxed mb-6"></div>
                <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-2">Cài đặt (Terminal)</h4>
                <div class="bg-code-bg rounded-r-3 p-4 mb-6 relative group">
                    <code
                        class="font-mono text-sm text-green-400">nencer install <span id="detail-install-slug"></span></code>
                    <button
                        class="absolute right-2 top-2 p-1.5 bg-white/10 rounded hover:bg-white/20 text-white opacity-0 group-hover:opacity-100 transition-opacity"
                        title="Copy">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                    </button>
                </div>
                <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-2">Input / Output Mẫu</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-gray-50 dark:bg-gray-800 p-3 rounded-r-3 border border-border-light dark:border-p-dark-gray">
                        <span class="text-xs font-bold text-p-grey uppercase block mb-2">Input (Prompt)</span>
                        <code
                            class="text-xs text-p-dark dark:text-p-white font-mono block">"Create a SEO blog post about AI Agents"</code>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-800 p-3 rounded-r-3 border border-border-light dark:border-p-dark-gray">
                        <span class="text-xs font-bold text-p-grey uppercase block mb-2">Output (Result)</span>
                        <code
                            class="text-xs text-p-dark dark:text-p-white font-mono block">"# AI Agents: The Future...\n\nIn this post, we will explore..."</code>
                    </div>
                </div>
            </div>
            <div
                class="p-s-6 border-t border-border-light dark:border-p-dark-gray bg-white dark:bg-p-dark flex justify-between items-center">
                <!-- GitHub Link -->
                <a id="detail-github-link" href="#" target="_blank" rel="noopener noreferrer"
                    class="hidden px-4 py-2 rounded-r-3 border border-p-dark-gray text-p-dark dark:text-p-white hover:bg-gray-100 dark:hover:bg-gray-800 font-semibold transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-github">
                        <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                        <path d="M9 18c-4.51 2-5-2-7-2"></path>
                    </svg>
                    GitHub
                </a>
                <div class="flex gap-3">
                    <button onclick="toggleModal('detail-modal')"
                        class="px-6 py-2 rounded-r-3 border border-border-light dark:border-p-dark-gray text-p-dark dark:text-p-white hover:bg-gray-100 dark:hover:bg-gray-800 font-semibold transition-colors">Đóng</button>
                    <button id="btn-download-skill" onclick="downloadSkill()"
                        class="px-6 py-2 rounded-r-3 bg-primary text-white hover:bg-[#085a96] shadow-lg shadow-primary/20 font-bold transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" x2="12" y1="15" y2="3"></line>
                        </svg>
                        Tải về Skill
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal My Skills -->
    <div id="myskills-modal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleModal('myskills-modal')"></div>
        <div
            class="relative bg-white dark:bg-p-dark w-full max-w-2xl mx-4 rounded-r-5 shadow-modal border border-border-light dark:border-p-dark-gray overflow-hidden flex flex-col max-h-[85vh]">
            <div
                class="p-s-6 border-b border-border-light dark:border-p-dark-gray bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary/10 rounded-r-3 flex items-center justify-center text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-heading-1 text-p-dark dark:text-p-white">My Skills</h3>
                        <p class="text-xs text-p-grey">Quản lý các skill bạn đã upload</p>
                    </div>
                </div>
                <button onclick="toggleModal('myskills-modal')"
                    class="text-p-grey hover:text-p-dark dark:hover:text-p-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div id="myskills-content" class="p-s-6 overflow-y-auto flex-1">
                <!-- Content will be rendered by JS -->
                <div class="text-center py-10 text-p-grey">
                    <p>Đang tải...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Logic -->
    <script>
        const SUPABASE_URL = 'https://buvjmekdaddnyxzlqypl.supabase.co'; // Điền URL của bạn
        const SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJ1dmptZWtkYWRkbnl4emxxeXBsIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzAzMDUwMjYsImV4cCI6MjA4NTg4MTAyNn0.ygGy8UGNwCofUNrPNKQByRD4rUg9fr1GqTy83WjUyKQ'; // Điền Key Anon

        let supabaseClient = null;
        let useMockData = true;

        // --- 1. Init Supabase ---
        if (SUPABASE_URL && SUPABASE_KEY) {
            try {
                supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_KEY);
                useMockData = false;
                console.log("✅ Supabase initialized!");
            } catch (e) {
                console.error("Supabase init error:", e);
            }
        } else {
            console.warn("⚠️ Chưa cấu hình Supabase. Đang sử dụng Mock Data.");
            document.getElementById('db-status').classList.remove('hidden');
        }

        // --- 2. State & Mock DB ---
        const categories = ["Tất cả", "Marketing", "Coding", "Data Analysis", "Support", "HR", "Design"];
        let mockDB = []; // (Populated below in init)

        const state = {
            currentPage: 1,
            itemsPerPage: 6,
            currentCategory: 'Tất cả',
            searchQuery: '',
            isLoading: false,
            totalItems: 0,
            totalPages: 0,
            data: [],
            user: null, // Stores current logged in user
            viewMode: 'grid', // 'grid' or 'list'
            starsCache: {} // Cache GitHub stars: { 'owner/repo': stars }
        };

        // --- 3. Authentication Logic ---

        // Sync user data to public.users table
        async function syncUserToDatabase(user) {
            if (!user || useMockData || !supabaseClient) return;

            try {
                const userData = {
                    id: user.id,
                    email: user.email,
                    full_name: user.user_metadata?.full_name || user.user_metadata?.name || user.email.split('@')[0],
                    avatar_url: user.user_metadata?.avatar_url || null,
                    updated_at: new Date().toISOString()
                };

                // Upsert: Insert if not exists, Update if exists
                const { data, error } = await supabaseClient
                    .from('users')
                    .upsert(userData, {
                        onConflict: 'id',
                        ignoreDuplicates: false
                    })
                    .select();

                if (error) {
                    console.error('Error syncing user to database:', error);
                } else {
                    console.log('✅ User synced to database:', data);
                }
            } catch (err) {
                console.error('Error in syncUserToDatabase:', err);
            }
        }

        async function checkAuth() {
            if (!useMockData && supabaseClient) {
                // Kiểm tra Session hiện tại
                const { data: { session } } = await supabaseClient.auth.getSession();
                state.user = session?.user || null;

                // Sync user if already logged in
                if (state.user) {
                    await syncUserToDatabase(state.user);
                }

                // Lắng nghe thay đổi trạng thái (đăng nhập/đăng xuất)
                supabaseClient.auth.onAuthStateChange(async (event, session) => {
                    console.log('Auth Event:', event);
                    state.user = session?.user || null;
                    renderHeaderAuth();
                    if (event === 'SIGNED_IN') {
                        // Sync user to public.users table
                        await syncUserToDatabase(session?.user);
                        showToast("Đăng nhập thành công!");
                        // Đóng modal nếu đang mở
                        const loginModal = document.getElementById('login-modal');
                        if (!loginModal.classList.contains('hidden')) toggleModal('login-modal');
                    }
                });
            } else {
                // Check local storage for mock login
                const mockUser = localStorage.getItem('nencer_mock_user');
                if (mockUser) state.user = JSON.parse(mockUser);
            }
            renderHeaderAuth();
        }

        async function handleLogin(provider) {
            if (provider === 'mock') {
                // Mock Login
                const fakeUser = { email: 'demo@nencer.vn', id: 'mock-id-123' };
                state.user = fakeUser;
                localStorage.setItem('nencer_mock_user', JSON.stringify(fakeUser));
                showToast("Đăng nhập Mock thành công!");
                toggleModal('login-modal');
                renderHeaderAuth();
            } else if (!useMockData && supabaseClient) {
                // Real Supabase Login (Generic for Google, GitHub, etc.)
                try {
                    const { data, error } = await supabaseClient.auth.signInWithOAuth({
                        provider: provider,
                        options: {
                            redirectTo: window.location.href // Quan trọng: Redirect về lại trang này
                        }
                    });
                    if (error) throw error;
                    // Không cần làm gì thêm ở đây, trình duyệt sẽ tự chuyển hướng
                } catch (error) {
                    alert(`Lỗi đăng nhập ${provider}: ` + error.message);
                }
            } else {
                alert("Vui lòng cấu hình Supabase URL/Key để dùng tính năng này.");
            }
        }

        async function handleLogout() {
            if (!useMockData && supabaseClient) {
                try {
                    // Sign out with global scope to clear all sessions
                    await supabaseClient.auth.signOut({ scope: 'global' });

                    // Clear any lingering Supabase storage keys that might prevent re-login
                    const supabaseKeys = Object.keys(localStorage).filter(key =>
                        key.startsWith('sb-') || key.includes('supabase')
                    );
                    supabaseKeys.forEach(key => localStorage.removeItem(key));

                    // Also clear session storage
                    const sessionKeys = Object.keys(sessionStorage).filter(key =>
                        key.startsWith('sb-') || key.includes('supabase')
                    );
                    sessionKeys.forEach(key => sessionStorage.removeItem(key));
                } catch (error) {
                    console.error('Logout error:', error);
                }
            } else {
                localStorage.removeItem('nencer_mock_user');
            }
            state.user = null;
            showToast("Đã đăng xuất.");
            renderHeaderAuth();
        }

        function renderHeaderAuth() {
            const btnLogin = document.getElementById('btn-login');
            const userView = document.getElementById('user-view');
            const userEmail = document.getElementById('user-email-display');
            const userAvatarInit = document.getElementById('user-avatar-initial');
            const userAvatarImg = document.getElementById('user-avatar-img');
            const upAuthor = document.getElementById('up_author');

            if (state.user) {
                btnLogin.classList.add('hidden');
                userView.classList.remove('hidden');
                userEmail.textContent = state.user.email;

                // Handle Avatar (Google usually provides avatar_url in user_metadata)
                const avatarUrl = state.user.user_metadata?.avatar_url;
                if (avatarUrl) {
                    userAvatarImg.src = avatarUrl;
                    userAvatarImg.classList.remove('hidden');
                    userAvatarInit.classList.add('hidden');
                } else {
                    userAvatarImg.classList.add('hidden');
                    userAvatarInit.classList.remove('hidden');
                    userAvatarInit.textContent = state.user.email.charAt(0).toUpperCase();
                }

                // Auto fill author field if empty
                if (upAuthor && !upAuthor.value) {
                    upAuthor.value = state.user.user_metadata?.full_name || state.user.email.split('@')[0];
                }
            } else {
                btnLogin.classList.remove('hidden');
                userView.classList.add('hidden');
                if (upAuthor) upAuthor.value = '';
            }
        }

        // --- 4. Data Fetching ---
        const generateMockData = () => {
            const bases = [
                { t: "Content Writer Pro", c: "Marketing", desc: "Workflow tự động nghiên cứu từ khóa, lập dàn ý và viết bài chuẩn SEO.", tag: ["SEO", "Writing"], bg: "bg-blue-50 dark:bg-blue-900/20", color: "text-primary" },
                { t: "Code Reviewer", c: "Coding", desc: "Tự động phân tích Pull Request, tìm lỗi bảo mật (SAST).", tag: ["DevOps", "Security"], bg: "bg-purple-50 dark:bg-purple-900/20", color: "text-purple-600" },
                { t: "Data Viz Bot", c: "Data Analysis", desc: "Chuyển đổi dữ liệu thô từ Excel/CSV thành biểu đồ.", tag: ["Data", "Viz"], bg: "bg-orange-50 dark:bg-orange-900/20", color: "text-orange-600" }
            ];
            let data = [];
            for (let i = 0; i < 30; i++) {
                const base = bases[i % bases.length];
                data.push({
                    id: i + 1,
                    title: `${base.t} ${Math.floor(i / bases.length) + 1}`,
                    desc: base.desc,
                    version: 'v1.0.0',
                    tags: base.tag,
                    category: base.c,
                    author: "Nencer User",
                    downloads: Math.floor(Math.random() * 2000) + 100,
                    icon_color: base.color,
                    bg_icon: base.bg,
                    badge_bg: "bg-gray-100 dark:bg-gray-700",
                    badge_text: "text-p-dark dark:text-gray-300",
                    icon_svg: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path></svg>`
                });
            }
            return data;
        };

        async function fetchSkillsAPI(params) {
            state.isLoading = true;
            renderSkeleton();

            if (!useMockData && supabaseClient) {
                try {
                    let query = supabaseClient.from('skills').select('*', { count: 'exact' });
                    if (params.category !== 'Tất cả') query = query.eq('category', params.category);
                    if (params.search) query = query.or(`title.ilike.%${params.search}%,desc.ilike.%${params.search}%`);

                    const start = (params.page - 1) * params.limit;
                    const end = start + params.limit - 1;
                    const { data, error, count } = await query.range(start, end).order('created_at', { ascending: false });

                    if (error) throw error;
                    state.isLoading = false;
                    return { data: data, total: count, totalPages: Math.ceil(count / params.limit), currentPage: params.page };
                } catch (err) {
                    console.error("Supabase error:", err);
                    state.isLoading = false;
                    return { data: [], total: 0, totalPages: 0, currentPage: 1 };
                }
            }

            // Mock Data Fallback
            return new Promise((resolve) => {
                setTimeout(() => {
                    let filtered = mockDB.filter(item => {
                        const matchCat = params.category === 'Tất cả' || item.category === params.category;
                        const q = params.search.toLowerCase();
                        const matchSearch = item.title.toLowerCase().includes(q) || item.desc.toLowerCase().includes(q);
                        return matchCat && matchSearch;
                    });
                    const total = filtered.length;
                    const totalPages = Math.ceil(total / params.limit);
                    const start = (params.page - 1) * params.limit;
                    const end = start + params.limit;
                    state.isLoading = false;
                    resolve({ data: filtered.slice(start, end), total, totalPages, currentPage: params.page });
                }, 500);
            });
        }

        // --- 5. Upload Handler ---
        document.getElementById('uploadForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            // Security Check
            if (!state.user) {
                showToast("Bạn cần đăng nhập để upload!");
                toggleModal('upload-modal');
                toggleModal('login-modal');
                return;
            }

            const btn = document.getElementById('btn-submit-upload');
            const originalText = btn.innerText;
            btn.innerText = "Đang xử lý...";
            btn.disabled = true;

            const newSkill = {
                title: document.getElementById('up_title').value,
                desc: document.getElementById('up_desc').value,
                category: document.getElementById('up_category').value,
                author: document.getElementById('up_author').value,
                link_git: document.getElementById('up_link_git').value || null,
                version: 'v1.0.0',
                downloads: 0,
                tags: [document.getElementById('up_category').value],
                user_id: state.user.id // Link skill to current user
            };

            if (!useMockData && supabaseClient) {
                const { error } = await supabaseClient.from('skills').insert([newSkill]);
                if (error) alert("Lỗi: " + error.message);
                else {
                    showToast("Upload thành công!");
                    toggleModal('upload-modal');
                    updateView();
                    document.getElementById('uploadForm').reset();
                }
            } else {
                newSkill.id = mockDB.length + 1;
                newSkill.bg_icon = 'bg-green-50 dark:bg-green-900/20';
                newSkill.icon_color = 'text-green-600';
                newSkill.icon_svg = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>`;
                newSkill.badge_bg = "bg-gray-100 dark:bg-gray-700";
                newSkill.badge_text = "text-p-dark dark:text-gray-300";

                mockDB.unshift(newSkill);
                setTimeout(() => {
                    showToast("Upload thành công (Mock)!");
                    toggleModal('upload-modal');
                    updateView();
                    document.getElementById('uploadForm').reset();
                }, 800);
            }
            btn.innerText = originalText;
            btn.disabled = false;
        });

        // --- 6. Render & Utils ---
        async function updateView() {
            const result = await fetchSkillsAPI({
                page: state.currentPage,
                limit: state.itemsPerPage,
                category: state.currentCategory,
                search: state.searchQuery
            });
            state.data = result.data;
            state.totalItems = result.total;
            state.totalPages = result.totalPages;
            renderSkills(state.data);
            renderPagination();
            updateResultCount();
        }

        function renderSkeleton() {
            const container = document.getElementById('skills-grid');
            let html = '';
            for (let i = 0; i < state.itemsPerPage; i++) {
                html += `<div class="bg-white dark:bg-[#2f3031] border border-border-light dark:border-p-dark-gray rounded-r-5 p-s-8 flex flex-col h-[280px] animate-pulse"><div class="flex justify-between items-start mb-s-6"><div class="w-12 h-12 rounded-r-3 skeleton"></div><div class="w-16 h-6 rounded-r-2 skeleton"></div></div><div class="w-3/4 h-6 mb-2 skeleton rounded"></div><div class="w-full h-4 mb-2 skeleton rounded"></div><div class="w-2/3 h-4 mb-s-8 skeleton rounded"></div></div>`;
            }
            container.innerHTML = html;
        }

        function renderCategories() {
            const container = document.getElementById('category-filters');
            let html = '';
            categories.forEach((cat) => {
                const isActive = state.currentCategory === cat;
                const activeClass = isActive ? 'bg-primary text-white border-primary shadow-md' : 'border-border-light dark:border-p-dark-gray hover:border-primary text-p-grey dark:text-p-white bg-white dark:bg-transparent';
                html += `<button onclick="handleCategoryClick('${cat}')" class="category-tag px-s-6 py-s-2 border ${activeClass} text-link-text whitespace-nowrap transition-all duration-200">${cat}</button>`;
            });
            container.innerHTML = html;
        }

        function renderSkills(items) {
            const container = document.getElementById('skills-grid');

            // Update container classes based on view mode
            if (state.viewMode === 'list') {
                container.className = 'flex flex-col gap-4 min-h-[400px]';
            } else {
                container.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-s-10 min-h-[400px]';
            }

            if (items.length === 0) {
                container.innerHTML = `<div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20"><h3 class="text-heading-lg text-p-dark dark:text-p-white">Không tìm thấy kết quả</h3><button onclick="resetFilters()" class="mt-4 text-primary font-bold hover:underline">Xóa bộ lọc</button></div>`;
                return;
            }

            let html = '';
            items.forEach(skill => {
                const bgIcon = skill.bg_icon || 'bg-blue-50 dark:bg-blue-900/20';
                const iconColor = skill.icon_color || 'text-primary';
                const svg = skill.icon_svg || '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path></svg>';
                const badgeBg = skill.badge_bg || 'bg-gray-100 dark:bg-gray-700';
                const badgeText = skill.badge_text || 'text-p-dark dark:text-gray-300';
                const tags = skill.tags || [];
                const starsHtml = skill.link_git ? `<span id="stars-${skill.id}" class="text-[10px] text-yellow-500 flex items-center gap-1"><svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> <span class="star-count">...</span></span>` : '';

                if (state.viewMode === 'list') {
                    // List View
                    html += `
                    <div class="group bg-white dark:bg-[#2f3031] border border-border-light dark:border-p-dark-gray rounded-r-5 p-s-6 hover:border-primary transition-all duration-300 hover:shadow-custom-1 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-r-3 ${bgIcon} flex items-center justify-center ${iconColor} shrink-0">${svg}</div>
                        <div class="flex-grow min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 onclick="viewDetail(${skill.id})" class="text-heading-1 text-p-dark dark:text-p-white group-hover:text-primary transition-colors cursor-pointer truncate">${skill.title}</h3>
                                <span class="px-s-2 py-0.5 ${badgeBg} ${badgeText} text-xs rounded-r-2 font-bold shrink-0">${skill.version}</span>
                            </div>
                            <p class="text-p-grey text-body-sm truncate">${skill.desc || ''}</p>
                        </div>
                        <div class="flex items-center gap-4 shrink-0">
                            <div class="flex items-center gap-2 text-xs text-p-grey">
                                ${starsHtml}
                                <span class="flex items-center gap-1"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg> ${skill.downloads}</span>
                            </div>
                            <span class="text-xs text-p-grey">${skill.author || 'Unknown'}</span>
                            <button onclick="viewDetail(${skill.id})" class="text-link-text text-p-accent hover:text-primary flex items-center gap-1 text-[13px] bg-transparent border-none cursor-pointer shrink-0">
                                Chi tiết <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>`;
                } else {
                    // Grid View (default)
                    html += `
                    <div class="group bg-white dark:bg-[#2f3031] border border-border-light dark:border-p-dark-gray rounded-r-5 p-s-8 hover:border-primary transition-all duration-300 hover:shadow-custom-1 flex flex-col h-full transform hover:-translate-y-1">
                        <div class="flex justify-between items-start mb-s-6">
                            <div class="w-12 h-12 rounded-r-3 ${bgIcon} flex items-center justify-center ${iconColor}">${svg}</div>
                            <div class="flex flex-col items-end">
                                <span class="px-s-3 py-1 ${badgeBg} ${badgeText} text-xs rounded-r-2 font-bold mb-1">${skill.version}</span>
                                <div class="flex items-center gap-2">
                                    ${starsHtml}
                                    <span class="text-[10px] text-p-grey flex items-center gap-1"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg> ${skill.downloads}</span>
                                </div>
                            </div>
                        </div>
                        <h3 onclick="viewDetail(${skill.id})" class="text-heading-1 text-p-dark dark:text-p-white mb-s-2 group-hover:text-primary transition-colors cursor-pointer">${skill.title}</h3>
                        <p class="text-p-grey text-body-sm mb-s-8 flex-grow line-clamp-2">${skill.desc || ''}</p>
                        <div class="flex flex-wrap gap-s-2 mb-s-6">${tags.map(tag => `<span class="px-s-2 py-1 bg-gray-100 dark:bg-gray-700 text-p-grey dark:text-gray-300 text-xs rounded-r-1">#${tag}</span>`).join('')}</div>
                        <div class="pt-s-6 border-t border-border-light dark:border-p-dark-gray flex items-center justify-between">
                            <div class="flex items-center gap-s-2">
                                <div class="w-6 h-6 rounded-r-6 bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center text-[10px] text-white font-bold">${skill.author ? skill.author.charAt(0) : 'U'}</div>
                                <span class="text-xs text-p-grey font-medium">${skill.author || 'Unknown'}</span>
                            </div>
                            <button onclick="viewDetail(${skill.id})" class="text-link-text text-p-accent hover:text-primary flex items-center gap-1 text-[13px] bg-transparent border-none cursor-pointer">
                                Chi tiết <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>`;
                }
            });
            container.innerHTML = html;

            // Fetch GitHub stars for items with link_git
            items.forEach(skill => {
                if (skill.link_git) {
                    fetchGitHubStars(skill.id, skill.link_git);
                }
            });
        }

        function renderPagination() {
            const container = document.getElementById('pagination-container');
            if (state.totalPages <= 1) { container.innerHTML = ''; return; }
            let html = `<button onclick="handlePageChange(${state.currentPage - 1})" ${state.currentPage === 1 ? 'disabled' : ''} class="w-10 h-10 flex items-center justify-center rounded-r-3 border border-border-light dark:border-p-dark-gray bg-white dark:bg-p-dark hover:border-primary hover:text-primary disabled:opacity-50 transition-colors"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg></button>`;
            for (let i = 1; i <= state.totalPages; i++) {
                const activeClass = i === state.currentPage ? 'bg-primary text-white border-primary shadow-md' : 'bg-white dark:bg-p-dark text-p-dark dark:text-p-white border-border-light dark:border-p-dark-gray hover:border-primary hover:text-primary';
                html += `<button onclick="handlePageChange(${i})" class="w-10 h-10 flex items-center justify-center rounded-r-3 border text-sm font-bold ${activeClass} transition-all">${i}</button>`;
            }
            html += `<button onclick="handlePageChange(${state.currentPage + 1})" ${state.currentPage === state.totalPages ? 'disabled' : ''} class="w-10 h-10 flex items-center justify-center rounded-r-3 border border-border-light dark:border-p-dark-gray bg-white dark:bg-p-dark hover:border-primary hover:text-primary disabled:opacity-50 transition-colors"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></button>`;
            container.innerHTML = html;
        }

        function updateResultCount() {
            document.getElementById('result-count').innerHTML = `Hiển thị <b>${state.data.length}</b> kết quả (Tổng: ${state.totalItems})`;
        }

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        // --- 7. GitHub Stars Fetcher ---
        async function fetchGitHubStars(skillId, gitUrl) {
            // Parse GitHub URL to get owner/repo
            const match = gitUrl.match(/github\.com\/([^\/]+)\/([^\/]+)/);
            if (!match) return;

            const owner = match[1];
            const repo = match[2].replace(/\.git$/, '');
            const cacheKey = `${owner}/${repo}`;

            // Check cache first
            if (state.starsCache[cacheKey] !== undefined) {
                updateStarsDisplay(skillId, state.starsCache[cacheKey]);
                return;
            }

            try {
                const response = await fetch(`https://api.github.com/repos/${owner}/${repo}`, {
                    headers: {
                        'Accept': 'application/vnd.github.v3+json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    const stars = data.stargazers_count || 0;
                    state.starsCache[cacheKey] = stars;
                    updateStarsDisplay(skillId, stars);
                } else {
                    updateStarsDisplay(skillId, '-');
                }
            } catch (error) {
                console.error('GitHub API error:', error);
                updateStarsDisplay(skillId, '-');
            }
        }

        function updateStarsDisplay(skillId, stars) {
            const el = document.querySelector(`#stars-${skillId} .star-count`);
            if (el) {
                el.textContent = typeof stars === 'number' ? formatStars(stars) : stars;
            }
        }

        function formatStars(count) {
            if (count >= 1000) {
                return (count / 1000).toFixed(1) + 'k';
            }
            return count.toString();
        }

        // --- 8. View Mode Toggle ---
        window.setViewMode = (mode) => {
            state.viewMode = mode;

            // Update button styles
            const btnGrid = document.getElementById('btn-grid-view');
            const btnList = document.getElementById('btn-list-view');

            if (mode === 'grid') {
                btnGrid.className = 'p-2 rounded-r-2 bg-white dark:bg-p-dark shadow-sm text-primary transition-all';
                btnList.className = 'p-2 rounded-r-2 text-p-grey hover:text-primary transition-all';
            } else {
                btnGrid.className = 'p-2 rounded-r-2 text-p-grey hover:text-primary transition-all';
                btnList.className = 'p-2 rounded-r-2 bg-white dark:bg-p-dark shadow-sm text-primary transition-all';
            }

            // Re-render skills with new view mode
            renderSkills(state.data);
        };

        window.handleCategoryClick = (category) => { state.currentCategory = category; state.currentPage = 1; renderCategories(); updateView(); };
        window.handlePageChange = (page) => { if (page < 1 || page > state.totalPages) return; state.currentPage = page; updateView(); document.getElementById('category-filters').scrollIntoView({ behavior: 'smooth' }); };
        window.resetFilters = () => { document.getElementById('searchInput').value = ''; state.searchQuery = ''; state.currentCategory = 'Tất cả'; state.currentPage = 1; renderCategories(); updateView(); }

        let timeout = null;
        document.getElementById('searchInput').addEventListener('input', (e) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => { state.searchQuery = e.target.value.trim(); state.currentPage = 1; updateView(); }, 500);
        });

        window.toggleModal = (modalID) => {
            document.getElementById(modalID).classList.toggle('hidden');
            document.body.style.overflow = document.body.style.overflow === 'hidden' ? 'auto' : 'hidden';
        }

        // Current skill being viewed (for download)
        let currentViewingSkill = null;

        window.viewDetail = (id) => {
            const skill = state.data.find(s => s.id === id);
            if (!skill) return;
            
            // Store for download
            currentViewingSkill = skill;
            
            document.getElementById('detail-title').textContent = skill.title;

            // Parse markdown for description
            const descContent = skill.desc || '';
            if (typeof marked !== 'undefined') {
                document.getElementById('detail-desc').innerHTML = marked.parse(descContent);
            } else {
                document.getElementById('detail-desc').textContent = descContent;
            }

            document.getElementById('detail-author').textContent = `By ${skill.author || 'Unknown'} • Updated recently`;
            const tags = skill.tags || [];
            document.getElementById('detail-tags').innerHTML = tags.map(tag => `<span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-p-grey dark:text-gray-300 text-xs rounded-r-1">#${tag}</span>`).join('');
            
            // Show/hide GitHub link
            const githubLink = document.getElementById('detail-github-link');
            if (skill.link_git) {
                githubLink.href = skill.link_git;
                githubLink.classList.remove('hidden');
                githubLink.classList.add('flex');
            } else {
                githubLink.classList.add('hidden');
                githubLink.classList.remove('flex');
            }
            
            // Install slug
            const slug = skill.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            document.getElementById('detail-install-slug').textContent = slug;
            
            toggleModal('detail-modal');
        }

        window.downloadSkill = () => {
            if (!currentViewingSkill) {
                showToast('Không tìm thấy skill!');
                return;
            }
            
            const skill = currentViewingSkill;
            
            // If has GitHub link, redirect to download as ZIP
            if (skill.link_git) {
                const githubUrl = skill.link_git;
                // Convert GitHub URL to ZIP download URL
                // https://github.com/owner/repo -> https://github.com/owner/repo/archive/refs/heads/main.zip
                const zipUrl = githubUrl.replace(/\.git$/, '') + '/archive/refs/heads/main.zip';
                window.open(zipUrl, '_blank');
                
                // Increment download count (if using real DB)
                incrementDownloadCount(skill.id);
                showToast('Đang tải về từ GitHub...');
            } else {
                showToast('Skill này chưa có link download!');
            }
        }

        async function incrementDownloadCount(skillId) {
            if (useMockData || !supabaseClient) {
                // Mock: just increment locally
                const skill = mockDB.find(s => s.id === skillId);
                if (skill) skill.downloads = (skill.downloads || 0) + 1;
            } else {
                // Real DB: increment in Supabase
                try {
                    const { data: skill } = await supabaseClient
                        .from('skills')
                        .select('downloads')
                        .eq('id', skillId)
                        .single();
                    
                    if (skill) {
                        await supabaseClient
                            .from('skills')
                            .update({ downloads: (skill.downloads || 0) + 1 })
                            .eq('id', skillId);
                    }
                } catch (err) {
                    console.error('Failed to increment download count:', err);
                }
            }
        }

        // --- My Skills Functions ---
        let mySkillsData = [];

        async function openMySkills() {
            if (!state.user) {
                showToast("Bạn cần đăng nhập!");
                return;
            }
            toggleModal('myskills-modal');
            await fetchMySkills();
        }

        async function fetchMySkills() {
            const container = document.getElementById('myskills-content');
            container.innerHTML = `<div class="text-center py-10"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto"></div><p class="text-p-grey mt-3">Đang tải...</p></div>`;

            if (!useMockData && supabaseClient) {
                try {
                    const { data, error } = await supabaseClient
                        .from('skills')
                        .select('*')
                        .eq('user_id', state.user.id) // Filter by user_id
                        .order('created_at', { ascending: false });

                    if (error) throw error;
                    mySkillsData = data || [];
                    renderMySkills();
                } catch (err) {
                    console.error('Error fetching my skills:', err);
                    container.innerHTML = `<div class="text-center py-10 text-red-500">Có lỗi xảy ra: ${err.message}</div>`;
                }
            } else {
                // Mock data
                setTimeout(() => {
                    mySkillsData = mockDB.filter(s => s.author === 'Nencer User').slice(0, 5);
                    renderMySkills();
                }, 500);
            }
        }

        function renderMySkills() {
            const container = document.getElementById('myskills-content');

            if (mySkillsData.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-p-grey">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                <path d="M2 17l10 5 10-5"></path>
                                <path d="M2 12l10 5 10-5"></path>
                            </svg>
                        </div>
                        <h4 class="text-heading-1 text-p-dark dark:text-p-white mb-2">Chưa có skill nào</h4>
                        <p class="text-p-grey text-sm mb-4">Bắt đầu upload skill đầu tiên của bạn!</p>
                        <button onclick="toggleModal('myskills-modal'); toggleModal('upload-modal');" class="px-4 py-2 bg-primary text-white rounded-r-3 hover:bg-[#085a96] transition-colors">
                            Upload Skill
                        </button>
                    </div>`;
                return;
            }

            // Helper function to escape HTML
            const escapeHtml = (str) => {
                if (!str) return '';
                return String(str).replace(/[&<>"']/g, (m) => ({
                    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
                })[m]);
            };

            let html = '<div class="space-y-3">';
            mySkillsData.forEach(skill => {
                const safeTitle = escapeHtml(skill.title);
                const safeCategory = escapeHtml(skill.category);
                const safeVersion = escapeHtml(skill.version) || 'v1.0.0';
                const safeLinkGit = escapeHtml(skill.link_git);

                html += `
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800/50 rounded-r-3 border border-border-light dark:border-p-dark-gray hover:border-primary transition-colors group">
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="w-10 h-10 rounded-r-3 bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold text-p-dark dark:text-p-white truncate">${safeTitle}</h4>
                                <p class="text-xs text-p-grey truncate">${safeCategory} • ${safeVersion}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            ${skill.link_git ? `<a href="${safeLinkGit}" target="_blank" class="p-2 text-p-grey hover:text-primary transition-colors" title="View on GitHub">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                            </a>` : ''}
                            <button class="btn-delete-skill p-2 text-p-grey hover:text-red-500 transition-colors" data-id="${skill.id}" data-title="${safeTitle}" title="Xóa skill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </div>
                    </div>`;
            });
            html += '</div>';
            html += `<div class="mt-4 pt-4 border-t border-border-light dark:border-p-dark-gray text-center">
                <button onclick="toggleModal('myskills-modal'); toggleModal('upload-modal');" class="text-primary hover:underline text-sm font-semibold">+ Upload skill mới</button>
            </div>`;
            container.innerHTML = html;

            // Add event listeners for delete buttons
            container.querySelectorAll('.btn-delete-skill').forEach(btn => {
                btn.addEventListener('click', function () {
                    // Don't parseInt - ID might be UUID string or bigint
                    const id = this.dataset.id;
                    const title = this.dataset.title;
                    deleteSkill(id, title);
                });
            });
        }

        async function deleteSkill(id, title) {
            if (!state.user) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Chưa đăng nhập',
                    text: 'Bạn cần đăng nhập để xóa skill!',
                    confirmButtonColor: '#0a68ac'
                });
                return;
            }

            // Confirm with SweetAlert2
            const result = await Swal.fire({
                title: 'Xác nhận xóa?',
                html: `Bạn có chắc muốn xóa skill <strong>"${title}"</strong>?<br><small class="text-gray-500">Hành động này không thể hoàn tác.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            });

            if (!result.isConfirmed) return;

            // Show loading
            Swal.fire({
                title: 'Đang xóa...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            console.log('Deleting skill:', { id, title, userId: state.user.id });

            if (!useMockData && supabaseClient) {
                try {
                    const { data, error } = await supabaseClient
                        .from('skills')
                        .delete()
                        .eq('id', id)
                        .eq('user_id', state.user.id)
                        .select();

                    console.log('Delete response:', { data, error });

                    if (error) throw error;

                    if (data && data.length > 0) {
                        // Remove from local array and re-render
                        mySkillsData = mySkillsData.filter(s => String(s.id) !== String(id));
                        renderMySkills();
                        updateView();

                        Swal.fire({
                            icon: 'success',
                            title: 'Đã xóa!',
                            text: `Skill "${title}" đã được xóa thành công.`,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Không thể xóa',
                            text: 'Skill không tồn tại hoặc bạn không có quyền xóa.',
                            confirmButtonColor: '#0a68ac'
                        });
                    }
                } catch (err) {
                    console.error('Delete error:', err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi xóa',
                        text: err.message,
                        confirmButtonColor: '#0a68ac'
                    });
                }
            } else {
                // Mock mode
                const originalLength = mockDB.length;
                mockDB = mockDB.filter(s => String(s.id) !== String(id));

                if (mockDB.length < originalLength) {
                    mySkillsData = mySkillsData.filter(s => String(s.id) !== String(id));
                    renderMySkills();
                    updateView();

                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xóa!',
                        text: `Skill "${title}" đã được xóa (Mock).`,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Không tìm thấy',
                        text: 'Không tìm thấy skill để xóa.',
                        confirmButtonColor: '#0a68ac'
                    });
                }
            }
        }

        window.openMySkills = openMySkills;
        window.deleteSkill = deleteSkill;

        // --- Init ---
        document.addEventListener('DOMContentLoaded', () => {
            mockDB = generateMockData();
            renderCategories();

            const themeToggleBtn = document.getElementById('theme-toggle');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            function setTheme(isDark) {
                if (isDark) { document.documentElement.classList.add('dark'); localStorage.setItem('color-theme', 'dark'); lightIcon.classList.remove('hidden'); darkIcon.classList.add('hidden'); }
                else { document.documentElement.classList.remove('dark'); localStorage.setItem('color-theme', 'light'); lightIcon.classList.add('hidden'); darkIcon.classList.remove('hidden'); }
            }
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) { setTheme(true); } else { setTheme(false); }
            themeToggleBtn.addEventListener('click', function () { const isDark = document.documentElement.classList.contains('dark'); setTheme(!isDark); });

            checkAuth(); // Check user session
            updateView();
        });
    </script>
</body>

</html>