module.exports = {
    purge: ["./src/**/*.{js,jsx,ts,tsx}", "./public/index.html"],
    darkMode: true, // or 'media' or 'class'
    mode: "jit",
    theme: {
        screens: {
            "2sm": "425px",
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            ms: "320px",
            mm: "375px",
            ml: "428px",
        },
    },
    variants: {
        extend: {
            borderColor: ["responsive", "hover", "focus", "active"],
        },
    },
};


const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      backgroundImage: {
        'sample': "url('/')",
      }
    },
  },
  // ...
}
