/**
 * NextAgents Skill - Utility Functions
 * Thư viện helper functions tự viết
 */

/**
 * Format date to Vietnamese locale
 * @param {Date|string} date 
 * @returns {string}
 */
function formatDateVN(date) {
    const d = new Date(date);
    return d.toLocaleDateString('vi-VN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    });
}

/**
 * Format number with thousand separator
 * @param {number} num 
 * @returns {string}
 */
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/**
 * Debounce function
 * @param {Function} func 
 * @param {number} wait 
 * @returns {Function}
 */
function debounce(func, wait = 300) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Copy text to clipboard
 * @param {string} text 
 * @returns {Promise<boolean>}
 */
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        return true;
    } catch (err) {
        console.error('Failed to copy:', err);
        return false;
    }
}

/**
 * Generate slug from string
 * @param {string} str 
 * @returns {string}
 */
function slugify(str) {
    return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

/**
 * Truncate string with ellipsis
 * @param {string} str 
 * @param {number} maxLength 
 * @returns {string}
 */
function truncate(str, maxLength = 100) {
    if (str.length <= maxLength) return str;
    return str.slice(0, maxLength - 3) + '...';
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        formatDateVN,
        formatNumber,
        debounce,
        copyToClipboard,
        slugify,
        truncate
    };
}
