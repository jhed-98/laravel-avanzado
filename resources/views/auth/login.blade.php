<x-guest-layout>
    <!-- component -->
    <div class="flex h-screen lg:h-[calc(100vh-100px)]">
        <!-- Left Pane -->
        <div class="hidden lg:flex items-center justify-center flex-1 bg-white text-black">
            <div class="max-w-md text-center">
                <img src="https://res.cloudinary.com/dt2emntbv/image/upload/v1741293541/samples/dw1kqzzponini9vytidh.svg"
                    class="w-full">
            </div>
        </div>
        <!-- Right Pane -->
        <div class="w-full bg-gray-200 lg:w-[30%] flex items-center justify-center">
            <div class="max-w-md w-full p-6 text-gray-600  ">
                <h1 class="text-3xl font-semibold mb-6  text-center">Log in to your account</h1>

                <form method="POST" action="{{ route('login') }}" class="space-y-4 text-gray-700">
                    @csrf
                    <div>
                        <x-wireui:input label="Email" name="email" type="email" />
                    </div>
                    <div>
                        <x-wireui:password label="Password" name="password" />
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                            Log in</button>
                    </div>
                </form>
                <hr class="mt-4 bg-gray-800/50 h-[2px]">
                <div class="mt-4 mx-4 flex flex-col items-center justify-between space-y-2">
                    <div class="w-full">
                        <button type="button"
                            class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-100 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4" id="google">
                                <path fill="#fbbb00"
                                    d="M113.47 309.408 95.648 375.94l-65.139 1.378C11.042 341.211 0 299.9 0 256c0-42.451 10.324-82.483 28.624-117.732h.014L86.63 148.9l25.404 57.644c-5.317 15.501-8.215 32.141-8.215 49.456.002 18.792 3.406 36.797 9.651 53.408z">
                                </path>
                                <path fill="#518ef8"
                                    d="M507.527 208.176C510.467 223.662 512 239.655 512 256c0 18.328-1.927 36.206-5.598 53.451-12.462 58.683-45.025 109.925-90.134 146.187l-.014-.014-73.044-3.727-10.338-64.535c29.932-17.554 53.324-45.025 65.646-77.911h-136.89V208.176h245.899z">
                                </path>
                                <path fill="#28b446"
                                    d="m416.253 455.624.014.014C372.396 490.901 316.666 512 256 512c-97.491 0-182.252-54.491-225.491-134.681l82.961-67.91c21.619 57.698 77.278 98.771 142.53 98.771 28.047 0 54.323-7.582 76.87-20.818l83.383 68.262z">
                                </path>
                                <path fill="#f14336"
                                    d="m419.404 58.936-82.933 67.896C313.136 112.246 285.552 103.82 256 103.82c-66.729 0-123.429 42.957-143.965 102.724l-83.397-68.276h-.014C71.23 56.123 157.06 0 256 0c62.115 0 119.068 22.126 163.404 58.936z">
                                </path>
                            </svg> Sign Up with Google </button>
                    </div>
                    <div class="w-full">
                        <button type="button"
                            class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-100 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                            <svg viewBox="0 -28.5 256 256" xmlns="http://www.w3.org/2000/svg" id="azure"
                                class="w-4">
                                <path
                                    d="M118.431947,187.698037 C151.322003,181.887937 178.48731,177.08008 178.799309,177.013916 L179.366585,176.893612 L148.31513,139.958881 C131.236843,119.644776 117.26369,102.945381 117.26369,102.849118 C117.26369,102.666861 149.32694,14.3716012 149.507189,14.057257 C149.567455,13.952452 171.38747,51.62411 202.400338,105.376064 C231.435152,155.699606 255.372949,197.191547 255.595444,197.580359 L255.999996,198.287301 L157.315912,198.274572 L58.6318456,198.261895 L118.431947,187.698073 L118.431947,187.698037 Z M-4.03864498e-06,176.434723 C-4.03864498e-06,176.382721 14.631291,150.983941 32.5139844,119.992969 L65.0279676,63.6457518 L102.919257,31.8473052 C123.759465,14.3581634 140.866667,0.0274832751 140.935253,0.00062917799 C141.003839,-0.0247829554 140.729691,0.665213042 140.326034,1.53468179 C139.922377,2.40415053 121.407304,42.1170321 99.1814268,89.7855264 L58.7707514,176.455514 L29.3853737,176.492355 C13.2234196,176.512639 -4.03864498e-06,176.486664 -4.03864498e-06,176.434703 L-4.03864498e-06,176.434723 Z"
                                    fill="#0089D6" fill-rule="nonzero"> </path>
                            </svg>Sign Up with Azure </button>
                    </div>
                    <div class="w-full">
                        <button type="button"
                            class="w-full flex justify-center items-center gap-2 bg-white text-sm text-gray-600 p-2 rounded-md hover:bg-gray-100 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="github" class="w-4">
                                <path
                                    d="M7.999 0C3.582 0 0 3.596 0 8.032a8.031 8.031 0 0 0 5.472 7.621c.4.074.546-.174.546-.387 0-.191-.007-.696-.011-1.366-2.225.485-2.695-1.077-2.695-1.077-.363-.928-.888-1.175-.888-1.175-.727-.498.054-.488.054-.488.803.057 1.225.828 1.225.828.714 1.227 1.873.873 2.329.667.072-.519.279-.873.508-1.074-1.776-.203-3.644-.892-3.644-3.969 0-.877.312-1.594.824-2.156-.083-.203-.357-1.02.078-2.125 0 0 .672-.216 2.2.823a7.633 7.633 0 0 1 2.003-.27 7.65 7.65 0 0 1 2.003.271c1.527-1.039 2.198-.823 2.198-.823.436 1.106.162 1.922.08 2.125.513.562.822 1.279.822 2.156 0 3.085-1.87 3.764-3.652 3.963.287.248.543.738.543 1.487 0 1.074-.01 1.94-.01 2.203 0 .215.144.465.55.386A8.032 8.032 0 0 0 16 8.032C16 3.596 12.418 0 7.999 0z">
                                </path>
                            </svg> Sign Up with Github </button>
                    </div>
                </div>
                <div class="mt-4 text-sm text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class=" font-bold hover:underline">
                            Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- FOOTER --}}
    <footer class="bg-gray-200/50 font-sans">
        <div class="container px-6 py-12 mx-auto">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">
                <div class="sm:col-span-2">
                    <h1 class="max-w-lg text-xl font-semibold tracking-tight text-gray-500 xl:text-2xl">
                        Subscribe our newsletter to get an update.</h1>

                    <div class="flex flex-col mx-auto mt-6 space-y-3 md:space-y-0 md:flex-row">
                        <input id="email_susc" type="text"
                            class="px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300"
                            placeholder="Email Address" />

                        <button
                            class="w-full px-6 py-2.5 text-sm font-medium tracking-wider text-white transition-colors duration-300 transform md:w-auto md:mx-4 focus:outline-none bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                            Subscribe
                        </button>
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-gray-600">Quick Link</p>

                    <div class="flex flex-col items-start mt-5 space-y-2">
                        <p
                            class="text-gray-500 transition-colors duration-300 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Home</p>
                        <p
                            class="text-gray-500 transition-colors duration-300 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Who We Are</p>
                        <p
                            class="text-gray-500 transition-colors duration-300 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Our Philosophy</p>
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-gray-600">Industries</p>

                    <div class="flex flex-col items-start mt-5 space-y-2">
                        <p
                            class="text-gray-500 transition-colors duration-300 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Retail & E-Commerce</p>
                        <p
                            class="text-gray-500 transition-colors duration-300 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Information Technology</p>
                        <p
                            class="text-gray-500 transition-colors duration-300 hover:underline hover:cursor-pointer hover:text-blue-500">
                            Finance & Insurance</p>
                    </div>
                </div>
            </div>

            <hr class="my-6 border-gray-200 md:my-8 h-2" />

            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex flex-1 gap-4">
                    <img src="https://www.svgrepo.com/show/303139/google-play-badge-logo.svg" width="130"
                        height="110" alt="" class="hover:cursor-pointer" />
                    <img src="https://www.svgrepo.com/show/303128/download-on-the-app-store-apple-logo.svg"
                        width="130" height="110" alt="" class="hover:cursor-pointer" />
                </div>

                <div class="flex gap-4 hover:cursor-pointer">
                    <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30"
                        alt="fb" />
                    <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30"
                        alt="tw" />
                    <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30"
                        alt="inst" />
                    <img src="https://www.svgrepo.com/show/94698/github.svg" class="" width="30"
                        height="30" alt="gt" />
                    <img src="https://www.svgrepo.com/show/22037/path.svg" width="30" height="30"
                        alt="pn" />
                    <img src="https://www.svgrepo.com/show/28145/linkedin.svg" width="30" height="30"
                        alt="in" />
                    <img src="https://www.svgrepo.com/show/22048/dribbble.svg" class="" width="30"
                        height="30" alt="db" />
                </div>
            </div>
            <p class="font-sans p-8 text-start md:text-center md:text-lg md:p-4 text-gray-500">©
                {{ now()->format('Y') }} You Company
                Inc. All rights
                reserved.</p>
        </div>
    </footer>
</x-guest-layout>
