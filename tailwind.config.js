/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./*.html", "./assets/js/**/*.js"],
  darkMode: "class",
  safelist: [
    "bg-[#085a96]",
    "bg-[#24292e]",
    "min-h-[400px]",
    "max-h-[90vh]",
    "max-h-[85vh]",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#0a68ac",
        "p-dark": "#242526",
        "p-white": "#ffffff",
        "p-accent": "#0d6efd",
        "p-grey": "#808080",
        "p-dark-gray": "#495057",
        "p-header-dark": "#031a2a",
        "border-pri": "#0a68ac",
        "border-light": "#e9e9e9",
        "footer-bg": "#f8f9fa",
        "footer-dark": "#18191a",
        "code-bg": "#2d2d2d",
      },
      fontFamily: {
        roboto: ["Roboto", "sans-serif"],
        mono: ["Fira Code", "monospace"],
      },
      fontSize: {
        "heading-1": ["16.1px", { lineHeight: "1.5", fontWeight: "600" }],
        "heading-lg": ["24px", { lineHeight: "1.3", fontWeight: "700" }],
        "btn-text": ["18.2px", { lineHeight: "1.5", fontWeight: "700" }],
        "link-text": ["15.05px", { lineHeight: "1.5", fontWeight: "600" }],
        "body-sm": ["14px", { lineHeight: "1.5" }],
        "body-xs": ["12px", { lineHeight: "1.5" }],
      },
      spacing: {
        "s-1": "2px",
        "s-2": "5px",
        "s-3": "8px",
        "s-4": "10px",
        "s-5": "11.375px",
        "s-6": "12px",
        "s-7": "15px",
        "s-8": "16px",
        "s-10": "20px",
        "s-11": "24px",
        "s-12": "25px",
        "s-16": "64px",
      },
      borderRadius: {
        "r-1": "4px",
        "r-2": "5px",
        "r-3": "8px",
        "r-4": "10px",
        "r-5": "12px",
        "r-6": "50%",
        tag: "0.75rem",
      },
      boxShadow: {
        "custom-1": "0px 10px 30px -10px rgba(0, 0, 0, 0.1)",
        modal:
          "0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)",
      },
      animation: {
        "pulse-fast": "pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite",
      },
    },
  },
  plugins: [],
};
