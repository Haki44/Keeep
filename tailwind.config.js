const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                purple: {
                    50: '#eae9ff', 
                    100: '#d9d7ff', 
                    200: '#bdb7ff', 
                    300: '#998bff', 
                    400: '#7f5dff', 
                    500: '#7539ff', 
                    600: '#7017ff', 
                    700: '#6a0cf6', 
                    800: '#540ec5',
                    900: '#341074', 
                }, 
                yellow: {
                    900: '#f5b276',
                },
            },
            backgroundImage: {
                'home-page': "url('/img/home-background.png')",
                'footer-texture': "url('/img/footer-texture.png')",
            }
        },
        
    },
    theme: {
        colors: {
            'yellowkeeep': '#f5b276',
        },
    },
    
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },


};
