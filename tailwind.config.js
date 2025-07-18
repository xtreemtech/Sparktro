import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import colors from "tailwindcss/colors"; // Import default Tailwind colors

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    safelist: ["bg-[#0A97B0]"], // Keep this if you need to dynamically generate this class

    theme: {
        extend: {
            fontFamily: {
                sans: ["'Work Sans'", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Spread default Tailwind colors first to extend them
                ...colors, // This line is crucial for keeping default colors like blue-500, green-500, etc.

                // Now define your custom colors, overriding defaults where necessary
                // or creating new palettes.

                // Redefine 'gray' to use your sparktro shade while keeping others
                gray: {
                    ...colors.gray, // Keep default gray shades
                    sparktro: "#F1F1F1", // Add your custom sparktro shade
                    // If you want to use a specific default gray shade as 'sparktro', e.g.,
                    // 100: colors.gray[100],
                    // 200: colors.gray[200],
                    // ...
                    // 50: '#F8F9FA', // This was your old 'bg-gray-sparktro'
                    // 100: '#F1F1F1', // This is your new 'gray-sparktro'
                },

                // Define a full 'primary' palette with your sparktro color as a shade
                primary: {
                    50: '#E6F4F7', // Lighter shade based on #0A97B0
                    100: '#CDE9ED',
                    200: '#9AD3DE',
                    300: '#67BDCE',
                    400: '#34A7BE',
                    500: '#0A97B0', // Your primary-sparktro color
                    600: '#087A90', // A slightly darker shade for 600
                    700: '#065D6C',
                    800: '#044048',
                    900: '#022324',
                    sparktro: "#0A97B0", // Keep this alias if you use primary-sparktro directly
                },

                // Keep your other custom colors
                black: {
                    sparktro: "#1E2533",
                },
                red: {
                    sparktro: "#FF4340",
                    ...colors.red, // Keep default red shades if needed elsewhere
                },
                yellow: {
                    sparktro: "#FDCB02",
                    ...colors.yellow, // Keep default yellow shades if needed elsewhere
                },
                textTeal: {
                    sparktro: "#5BD1D7",
                },
                // Add specific shades used in charts/components if they are not default
                // For example, if you explicitly used 'blue-500' and 'green-500' from default palette
                // and you want to ensure they are available:
                blue: colors.blue,
                green: colors.green,
                purple: colors.purple, // For TopMetrics icon
            },
            // You can define border colors here if they are custom and not part of the main palette
            borderColor: {
                'gray-sparktro': '#E5E7EB', // This was 'border-gray-sparktro'
            }
        },
    },

    plugins: [forms],
};
