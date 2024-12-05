<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteAtlas</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="text-gray-800">
    <!-- Navigation Bar -->
    <nav class="sticky z-50 top-0 flex justify-between items-center px-8 py-4 bg-[#5CBBB4]">
        
        <!-- Logo Section -->
        <div class="text-2xl md:text-4xl font-bold bg-[#E5E9E9] rounded-md px-3 py-2 flex justify-center items-center">
            <img src="{{ url_for('static', filename='images/LogoWasteAtlas.png') }}" alt="WasteAtlas" class="w-10 h-10 md:w-12 md:h-12 inline-block mr-1">
            <span class="text-[#5CBBB4]">Waste</span><span class="text-[#EF9292]">Atlas</span>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex space-x-4">
            <a href="/" class="p-2 rounded bg-[#E5E9E9] transform transition-all duration-300 hover:scale-110">
                <img src="{{ url_for('static', filename='images/homebtn.png') }}" alt="Home" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <a href="/types" class="p-2 rounded bg-[#E5E9E9] transform transition-all duration-300 hover:scale-110">
                <img src="{{ url_for('static', filename='images/searchbtn.png') }}" alt="Learn" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <a href="/photo" class="p-2 rounded bg-[#E5E9E9] transform transition-all duration-300 hover:scale-110">
                <img src="{{ url_for('static', filename='images/snapbtnblue.png') }}" alt="Photo" class="w-10 h-10 md:w-12 md:h-12">
            </a>
            <a href="/image" class="p-2 rounded bg-[#E5E9E9] transform transition-all duration-300 hover:scale-110">
                <img src="{{ url_for('static', filename='images/uploadimagebtnblue.png') }}" alt="Photo" class="w-10 h-10 md:w-12 md:h-12">
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Welcome Area -->
        <section>
            <div class="flex flex-col justify-center items-center py-40 gap-y-5 bg-[#E5E9E9] text-center">
                <img src="{{ url_for('static', filename='images/LogoWasteAtlas.png') }}" alt="WasteAtlas" class="w-[300px] mx-auto transform transition-all duration-300 hover:scale-110">
                <div class="text-center">
                    <h1 class="text-8xl font-bold"><span class="text-[#5CBBB4]">Waste</span><span class="text-[#EF9292]">Atlas</span></h1>
                    <p class="my-4 text-4xl font-bold"><span class="text-[#5CBBB4]">Snap, Sort, and Sustain</span> <span class="text-[#EF9292]">with Ease</span></p>
                </div>
            </div>
        </section>

        <!-- About Us Area -->
        <section class="bg-[#5CBBB4] py-10 flex items-center">
            <div class="container my-auto mx-auto px-4 py-16">
                <div class="flex items-center justify-between gap-6">
                    <!-- Left side - Illustration -->
                    <div class="w-1/2">
                        <img src="{{ url_for('static', filename='images/aboutilus.png') }}" alt="WasteAtlas" class="w-[500px] max-w-full transform transition-all duration-300 hover:scale-110">
                    </div>
                    
                    <!-- Right side - Text Content -->
                    <div class="w-1/2 ">
                        <h1 class="text-3xl md:text-6xl font-bold mb-6 text-[#ffffff]">
                            <span class="text-[#FFA7A7]">Snap </span>
                            and 
                            <span class="text-[#FFA7A7]">Sort </span>
                            Your Waste to 
                            <span class="text-[#FFA7A7]">Sustain </span>
                            our Beloved Homeworld
                        </h1>
                        <p class="text-lg md:text-xl leading-relaxed text-white">
                            With WasteAtlas, every small step makes a big impact! Snap a photo to instantly identify waste types, discover easy tips for recycling and reusing, and contribute to a cleaner, greener planet. Let's make sustainability a way of life!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Take a Photo Area -->
        <section class="bg-[#EF9292] py-10 flex items-center">
            <div class="container my-auto mx-auto px-4 py-16">
                <div class="flex items-center justify-between gap-6">
                    <!-- Left side - Text Content and Button -->
                    <div class="w-1/2 text-right flex flex-col items-end">
                        
                        <h1 class="text-3xl md:text-6xl font-bold mb-6 text-[#ffffff]">
                            Take a 
                            <span class="text-[#58DED4]">Photo </span>of  
                            <span class="text-[#58DED4]">Your Waste</span>
                            and Let Us Do the Rest
                        </h1>
                        
                        <p class="text-lg md:text-xl leading-relaxed text-white">
                            Simply snap a photo of your waste and let WasteAtlas do it's job! Our AI-powered system will instantly identify the waste type and provide you with the description, environmental impact, dispose methods, and additional tips!
                        </p>
                        
                        <!-- Button to Try Photo Feature -->
                        <div class="flex mt-8">
                            <a href="/photo" class="bg-[#54C7BE] text-white font-bold py-2 px-9 rounded-md text-2xl transform transition-all duration-300 hover:scale-110">
                                Try Now!
                            </a>
                        </div>

                    </div>
                    
                    <!-- Right side - Illustration -->
                    <div class="w-1/2 flex justify-end">
                        <img src="{{ url_for('static', filename='images/photoilus.png') }}" alt="WasteAtlas" class="w-[500px] max-w-full transform transition-all duration-300 hover:scale-110">
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Waste Types Area -->
        <section class="bg-[#5CBBB4] py-10 flex items-center">
            <div class="container my-auto mx-auto px-4 py-16">
                <div class="flex items-center justify-between gap-6">
                    <!-- Left side - Illustration -->
                    <div class="w-1/2">
                        <img src="{{ url_for('static', filename='images/searchilus.png') }}" alt="WasteAtlas" class="w-[500px] max-w-full transform transition-all duration-300 hover:scale-110">
                    </div>
                    
                    <!-- Right side - Text Content -->
                    <div class="w-1/2 flex flex-col items-start">
                        <h1 class="text-3xl md:text-6xl font-bold mb-6 text-[#ffffff]">
                            <span class="text-[#FFA7A7]">Learn More </span>
                            About The Different 
                            <span class="text-[#FFA7A7]">Waste Types</span>
                        </h1>
                        <p class="text-lg md:text-xl leading-relaxed text-white">
                            Discover the world of waste! Explore detailed information about various waste categories, their environmental impact, and practical disposal methods. Learn sustainable practices to reduce, reuse, and recycle, contributing to a greener and healthier planet!
                        </p>
                        <!-- Button to Try Photo Feature -->
                        <div class="flex mt-8">
                            <a href="/types" class="bg-[#FFA7A7] text-white font-bold py-2 px-9 rounded-md text-2xl transform transition-all duration-300 hover:scale-110">
                                Learn Now!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    </main>

    <!-- Footer -->
    <footer class="flex flex-col items-center py-10 bg-[#E5E9E9]">
        <!-- Logo Section -->
        <div class="text-4xl font-bold flex justify-center items-center mb-6">
            <img src="{{ url_for('static', filename='images/LogoWasteAtlas.png') }}" alt="WasteAtlas" class="w-12 h-12 inline-block mr-1">
            <span class="text-[#5CBBB4]">Waste</span><span class="text-[#EF9292]">Atlas</span>
        </div>
    
        <!-- Developer Section -->
        <div class="text-center mb-8">
            <h2 class="text-[#5CBBB4] text-lg md:text-xl font-bold mb-2">Developed By</h2>
            <p class="text-[#EF9292] text-lg md:text-xl font-medium">Muhammad Efflin Rizqallah Limbong</p>
            <p class="text-[#EF9292] text-lg md:text-xl font-medium">22537144007</p>
        </div>
    
        <!-- Sources Section -->
        <div class="text-center">
            <h2 class="text-[#5CBBB4] text-lg md:text-xl font-bold mb-2">Sources</h2>
            <div class="flex justify-center space-x-20">
                <a href="https://github.com/flinrzqlh/apk_web_streamlit/tree/main/awworks/project_akhir/WasteAtlas" class="p-2 rounded-lg bg-white transform transition-all duration-300 hover:scale-110">
                    <img src="{{ url_for('static', filename='images/github.png') }}" alt="GitHub" class="w-10 h-10 md:w-12 md:h-12">
                </a>
                <a href="https://www.kaggle.com/datasets/sumn2u/garbage-classification-v2" class="p-2 rounded-lg bg-white transform transition-all duration-300 hover:scale-110">
                    <img src="{{ url_for('static', filename='images/dataset.png') }}" alt="Dataset" class="w-10 h-10 md:w-12 md:h-12">
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
