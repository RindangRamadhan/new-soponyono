<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/output.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Sedan&display=swap" rel="stylesheet">

  <style>
      .custom-strikethrough {
        text-decoration-color: #ff0000;
      }
    </style>
</head>
<body>
 <!-- Header -->
 <main class="overflow-hidden">
  
      <header class="h-[75px] w-full bg-[#12191C] px-6 xl:px-0">
        <nav
          class="max-w-[1100px] mx-auto flex items-center justify-between h-full"
        >
          <img src="./image/logo.png" alt="Logo" class="w-[50px] h-auto" />
          <ul class="flex items-center gap-4 xl:gap-40 text-white">
            <li class="cursor-pointer hover:underline">Home</li>
            <li class="cursor-pointer hover:underline">About</li>
            <li class="cursor-pointer hover:underline">Service</li>
            <li class="cursor-pointer hover:underline">Pricelist</li>
            <li class="cursor-pointer hover:underline">Galery</li>
          </ul>
        </nav>
      </header>
      <!-- Hero -->
      <section
        class="h-full lg:h-[calc(100vh_-_75px)] w-full bg-[url('/image/background_hero.png')] bg-cover relative"
      >

        <img
          src="./image/bg_overlay.png"
          alt="Background Overlay"
          class="h-full xl:h-[calc(100vh_-_75px)] w-full object-cover absolute"
        />
        <div
          class="flex flex-col-reverse md:flex-row items-center justify-between relative z-10 h-full gap-20 py-16 px-6 lg:px-0 lg:py-0 max-w-[1100px] mx-auto"
        >
          <img
            src="./image/hero_background.png"
            alt="background hero"
            class="w-full h-auto md:w-[450px] md:h-full lg:w-[550px] lg:h-[547px] object-cover hidden md:block"
          />
          <div class="flex flex-col gap-4">
            <p class="text-white font-light text-sm md:text-xl ">
              We Are New Suponyono
            </p>
            <h1
              class="bg-[linear-gradient(180deg,_#FFDD9A_0%,_#D19A2E_100%)] text-7xl md:text-8xl bg-clip-text text-transparent font-sedan"
            >
              Wedding <br />
              Organizer,
            </h1>
            <div class="flex gap-10 mt-6">
              <div
                class="w-[113px] h-[1px] bg-white mt-2 hidden md:block"
              ></div>
              <p class="text-xl text-white font-light w-full md:max-w-[323px]">
                Ciptakan Kenangan <br />
                Tak Terlupakan Bersama Kami
              </p>
            </div>
            <button
              class="text-[#6D5119] font-bold text-sm bg-[linear-gradient(90deg,_#F4CD7F_0%,_#E0B052_100%)] text-center w-[261px] h-[60px]"
            >
              Konsultasi Sekarang
            </button>
          </div>
        </div>
      </section>
      <!-- About Us -->
      <section
        class="w-full bg-[linear-gradient(180deg,_#21282C_0%,_#12191C_100%)] py-16"
      >
        <div
          class="max-w-[1100px] mx-auto h-full flex flex-col lg:flex-row justify-between px-6 lg:px-0"
        >
          <div class="lg:basis-6/12 flex flex-col gap-6">
            <p class="text-[#7A7A7A] font-semibold text-sm md:text-xl">
              About Us
            </p>
            <h4
              class="text-lg md:text-2xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#F4CC7E_0%,_#E1B152_100%)]"
            >
              PT SOPONYONO DADI KENCONO
            </h4>
            <h2
              class="text-2xl md:text-4xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#F4CC7E_0%,_#E1B152_100%)]"
            >
              Merupakan Perusahaan yang bergerak di bidang Pelayanan dan jasa.
            </h2>
            <p class="text-sm md:text-lg font-light text-white">
              “New Soponyono” sudah berdiri sejak tahun 2009 Dan kami sudah
              berdiri selama 15 tahun. Kami berkomitmen untuk membuat event atau
              pesta yang tak terlupakan dan penuh makna. Maka dari itu kami
              hadir untuk membantu konsumen mewujudkan impian tersebut.
            </p>
          </div>
          <div class="lg:basis-6/12 relative hidden lg:block">
            <img
              src="./image/about-us/image_1.png"
              alt="About us one"
              class="absolute right-0 w-[235px] h-[300px]"
            />
            <img
              src="./image/about-us/image_2.png"
              alt="About us one"
              class="absolute right-[200px] w-[235px] h-[200px] top-6"
            />
            <img
              src="./image/about-us/image_3.png"
              alt="About us one"
              class="absolute right-[150px] w-[235px] h-[120px] bottom-0"
            />
          </div>
        </div>
      </section>
      <!-- Service -->
      <section class="w-full bg-white py-16">
        <div class="max-w-[1100px] mx-auto flex flex-col gap-10 px-6 lg:px-0">
          <p
            class="text-[#7A7A7A] font-semibold text-sm md:text-xl text-center"
          >
            Service
          </p>
          <div class="grid grid-cols-12 gap-5">
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/wedding.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Wedding
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/akad.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Akad
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/lamaran.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Lamaran
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/khitan.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Khitan
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/cathering.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Cathering
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/tenda_dekorasi.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Tenda & Dekorasi
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/entertaiment.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Entertaintment
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/mua.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                MUA
              </div>
            </div>
            <div
              class="relative col-span-12 md:col-span-6 lg:col-span-4 rounded-[20px] bg-[url('/image/service/dokumentasi.png')] w-full h-[200px] bg-cover"
            >
              <div
                class="absolute rounded-tr-[32.97px] rounded-bl-[20px] bottom-0 left-0 bg-black flex items-center justify-center text-white text-lg px-6 py-2 font-semibold"
              >
                Dokumentasi
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Price list -->
      <section class="w-full bg-white py-16">
        <div class="max-w-[1100px] mx-auto flex flex-col gap-10 px-6 lg:px-0">
          <p
            class="text-[#7A7A7A] font-semibold text-sm lg:text-xl text-center"
          >
            Pricelist
          </p>
          <div class="grid grid-cols-12 gap-5 items-center">
            <div
              class="col-span-12 lg:col-span-4 w-full h-[475px] px-4 py-5 flex flex-col gap-3 bg-[#EEEEEE] rounded-[16px]"
            >
              <p class="text-[#12171A] font-medium text-xl">Paket Wedding</p>
              <div class="flex">
                <p class="text-sm text-[#12171A] font-bold">Rp</p>
                <h3 class="text-xl text-[#12171A] font-bold">22.000.000</h3>
              </div>
              <ul class="flex flex-col gap-3">
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Tenda</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Pelaminan</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Alat-alat</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Makeup</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Dokumentasi</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <circle
                      cx="9.13612"
                      cy="9.16719"
                      r="7.45839"
                      stroke="#B4B4B4"
                      stroke-width="1.62731"
                    />
                    <path
                      d="M11.5919 6.82288L6.92401 11.4907"
                      stroke="#B4B4B4"
                      stroke-width="1.33367"
                    />
                    <path
                      d="M6.92401 6.82288L11.5919 11.4907"
                      stroke="#B4B4B4"
                      stroke-width="1.33367"
                    />
                  </svg>

                  <p class="text-[#B4B4B4] font-light text-lg">Hiburan</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <circle
                      cx="9.13612"
                      cy="9.16719"
                      r="7.45839"
                      stroke="#B4B4B4"
                      stroke-width="1.62731"
                    />
                    <path
                      d="M11.5919 6.82288L6.92401 11.4907"
                      stroke="#B4B4B4"
                      stroke-width="1.33367"
                    />
                    <path
                      d="M6.92401 6.82288L11.5919 11.4907"
                      stroke="#B4B4B4"
                      stroke-width="1.33367"
                    />
                  </svg>

                  <p class="text-[#B4B4B4] font-light text-lg">
                    MC Profesional
                  </p>
                </li>
              </ul>
              <button
                class="border border-black rounded-[5px] text-[#12171A] font-bold text-sm py-4 mt-4"
              >
                Konsultasi Sekarang
              </button>
            </div>
            <div
              class="col-span-12 lg:col-span-4 w-full h-[500px] px-4 py-5 flex flex-col gap-3 bg-[#071319] rounded-[16px]"
            >
              <p
                class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-medium text-xl"
              >
                Paket Wedding Premium
              </p>
              <div class="flex">
                <p
                  class="text-sm bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-bold"
                >
                  Rp
                </p>
                <h3
                  class="text-xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-bold"
                >
                  50.000.000
                </h3>
              </div>
              <ul class="flex flex-col gap-3">
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    Tenda
                  </p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    Pelaminan
                  </p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    Alat-alat
                  </p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    Makeup
                  </p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    Dokumentasi
                  </p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    Hiburan
                  </p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="17"
                    height="17"
                    viewBox="0 0 17 17"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.47134 8.21591L7.1203 10.8649L12.0727 5.91248"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="8.27204"
                      cy="8.37165"
                      r="7.45839"
                      stroke="#FFC656"
                      stroke-width="1.62731"
                    />
                  </svg>

                  <p
                    class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-light text-lg"
                  >
                    MC Profesional
                  </p>
                </li>
              </ul>
              <button
                class="border border-[#FFC656] rounded-[5px] bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFC656_0%,_#C09237_100%)] font-bold text-sm py-4 mt-4"
              >
                Konsultasi Sekarang
              </button>
            </div>
            <div
              class="col-span-12 lg:col-span-4 w-full h-[475px] px-4 py-5 flex flex-col gap-3 bg-[#EEEEEE] rounded-[16px]"
            >
              <p class="text-[#12171A] font-medium text-xl">Paket Wedding</p>
              <div class="flex">
                <p class="text-sm text-[#12171A] font-bold">Rp</p>
                <h3 class="text-xl text-[#12171A] font-bold">35.000.000</h3>
              </div>
              <ul class="flex flex-col gap-3">
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Tenda</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Pelaminan</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Alat-alat</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Makeup</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Dokumentasi</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M5.33545 8.96493L7.9844 11.6139L12.9368 6.6615"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                    <circle
                      cx="9.13612"
                      cy="9.12068"
                      r="7.45839"
                      stroke="#12171A"
                      stroke-width="1.62731"
                    />
                  </svg>
                  <p class="text-[#12171A] font-light text-lg">Hiburan</p>
                </li>
                <li class="flex items-center gap-2">
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <circle
                      cx="9.13612"
                      cy="9.16719"
                      r="7.45839"
                      stroke="#B4B4B4"
                      stroke-width="1.62731"
                    />
                    <path
                      d="M11.5919 6.82288L6.92401 11.4907"
                      stroke="#B4B4B4"
                      stroke-width="1.33367"
                    />
                    <path
                      d="M6.92401 6.82288L11.5919 11.4907"
                      stroke="#B4B4B4"
                      stroke-width="1.33367"
                    />
                  </svg>

                  <p class="text-[#B4B4B4] font-light text-lg">
                    MC Profesional
                  </p>
                </li>
              </ul>
              <button
                class="border border-black rounded-[5px] text-[#12171A] font-bold text-sm py-4 mt-4"
              >
                Konsultasi Sekarang
              </button>
            </div>
          </div>
        </div>
      </section>
      <!-- Wedding Package -->
      <section
        class="w-full bg-[#181818] min-h-[500px] bg-[url('/image/wedding-package/bg_wedding_package.png')] bg-cover"
      >
        <div
          class="relative max-w-[1100px] mx-auto flex lg:justify-end px-6 lg:px-0"
        >
          <img
            src="./image/wedding-package/shape_wedding_package.png"
            alt="Wedding Package Shape"
            class="w-auto h-[550px] absolute left-0 top-0 hidden lg:block"
          />
          <div class="lg:basis-6/12 flex flex-col gap-6 h-full py-10">
            <div class="flex flex-col gap-3">
              <h2
                class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#F4CD7F_0%,_#E1B153_100%)] text-2xl"
              >
                Wedding Package
              </h2>
              <h1
                class="bg-clip-text text-transparent bg-[linear-gradient(180deg,_#F4CD7F_0%,_#E1B153_100%)] text-5xl"
              >
                Gedung & Aula
              </h1>
            </div>
            <div class="flex flex-col gap-3">
              <h5 class="text-white font-bold text-lg">
                Paket Pendopo Uti, Jati Asih
              </h5>
              <div class="flex gap-12">
                <ul class="flex flex-col gap-3">
                  <li class="text-white font-light text-sm md:text-lg">
                    - Venue
                  </li>
                  <li class="text-white font-light text-sm md:text-lg">
                    - Catering 800 pax
                  </li>
                  <li class="text-white font-light text-sm md:text-lg">
                    - Pelaminan Dekorasi
                  </li>
                  <li class="text-white font-light text-sm md:text-lg">
                    - Busana & Rias
                  </li>
                </ul>
                <ul class="flex flex-col gap-3">
                  <li class="text-white font-light text-sm md:text-lg">
                    - Dokumentasi
                  </li>

                  <li class="text-white font-light text-sm md:text-lg">
                    - Hiburan
                  </li>

                  <li class="text-white font-light text-sm md:text-lg">
                    - MC Akad & Adat
                  </li>

                  <li class="text-white font-light text-sm md:text-lg">
                    - Adat Jawa, Sunda dll
                  </li>
                </ul>
              </div>
            </div>
            <button
              class="text-[#6D5119] font-bold text-sm bg-[linear-gradient(90deg,_#F4CD7F_0%,_#E0B052_100%)] text-center w-[261px] h-[60px]"
            >
              Konsultasi Sekarang
            </button>
          </div>
        </div>
      </section>
      <!-- Gallery -->
      <section class="w-full bg-white py-16">
        <div class="max-w-[1100px] mx-auto flex flex-col gap-10 px-6 lg:px-0">
          <p class="text-[#7A7A7A] font-semibold text-xln text-center">
            Gallery
          </p>
          <div class="grid grid-rows-2 grid-flow-col gap-4">
            <img
              src="./image/gallery/img_1.png"
              alt="Gallery 1"
              class="col-span-4 object-cover w-full h-auto"
            />
            <img
              src="./image/gallery/img_2.png"
              alt="Gallery 2"
              class="col-span-4 object-cover w-full h-auto"
            />
            <img
              src="./image/gallery/img_4.png"
              alt="Gallery 4"
              class="col-span-4 object-cover w-full h-auto"
            />
            <img
              src="./image/gallery/img_5.png"
              alt="Gallery 5"
              class="col-span-4 object-cover w-full h-auto"
            />
            <img
              src="./image/gallery/img_3.png"
              alt="Gallery 3"
              class="col-span-4 row-span-2 object-cover w-full h-auto"
            />
          </div>
        </div>
      </section>
      <!-- Hiburan -->
      <section
        class="w-full relative min-h-[400px] bg-[#16191C] bg-[url('./image/hiburan/bg_hiburan.png')] bg-cover"
      >
        <img
          src="./image/hiburan/shape_hiburan.png"
          alt="Shape Hiburan"
          class="h-[430px] w-auto absolute right-0 -top-8 hidden lg:block"
        />
        <div
          class="max-w-[1100px] mx-auto flex flex-col gap-10 py-10 px-6 lg:px-0"
        >
          <div class="flex flex-col gap-1">
            <h5
              class="text-2xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFD278_0%,_#FFB628_100%)]"
            >
              Hiburan
            </h5>
            <h2
              class="text-4xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#FFD278_0%,_#FFB628_100%)]"
            >
              Campursari
            </h2>
          </div>
          <p
            class="text-white font-light text-base md:text-lg md:max-w-[500px] leading-[30px] tracking-[0.07em]"
          >
            untuk Acara yang lebih meriah Kami juga menyediakan perlengkapan
            hiburan campursari. Untuk informasi lebih lanjut, jangan ragu untuk
            Konsultasi dengan kami
          </p>
          <div
            class="flex flex-col md:flex-row gap-4 lg:gap-0 lg:items-center lg:justify-between max-w-[500px]"
          >
            <button
              class="text-[#6D5119] font-bold text-sm bg-[linear-gradient(90deg,_#F4CD7F_0%,_#E0B052_100%)] text-center w-[250px] h-[60px]"
            >
              Konsultasi Sekarang
            </button>
            <div class="flex items-center gap-2">
              <p class="font-bold text-base text-white">Lihat di Youtube</p>
              <svg
                width="50"
                height="50"
                viewBox="0 0 50 50"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
              >
                <rect width="50" height="50" fill="url(#pattern0_142_2174)" />
                <defs>
                  <pattern
                    id="pattern0_142_2174"
                    patternContentUnits="objectBoundingBox"
                    width="1"
                    height="1"
                  >
                    <use
                      xlink:href="#image0_142_2174"
                      transform="scale(0.00195312)"
                    />
                  </pattern>
                  <image
                    id="image0_142_2174"
                    width="512"
                    height="512"
                    xlink:href="data:image/png;base64,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"
                  />
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </section>
      <!-- Promo -->
      <section
        class="w-full relative min-h-[356px] bg-[linear-gradient(90deg,_#FFFFFF_0%,_rgba(233,232,201,0.7)_125%)]"
      >
        <img
          src="./image/promo/bg_promo.png"
          alt="Background Promo"
          class="h-[356px] w-full object-cover lg:object-contain object-no-repeat absolute top-0"
        />
        <div
          class="max-w-[1100px] mx-auto flex flex-col lg:flex-row gap-8 lg:gap-0 items-center justify-between py-10 px-6 lg:px-0"
        >
          <img
            src="./image/promo/bg_1.png"
            alt="Background"
            class="h-[200px] md:h-[275px] w-auto"
          />
          <div class="flex flex-col gap-4 w-[320px] relative z-10">
            <h3 class="font-bold text-[#CE3737] text-xl md:text-3xl">
              Promo Lamaran Special Kemerdekaan
            </h3>
            <div class="flex flex-col md:flex-row justify-between">
              <ul class="flex flex-col gap-2">
                <li class="text-[#1B2023] font-medium text-base">
                  - Dekorasi Lamaran
                </li>
                <li class="text-[#1B2023] font-medium text-base">
                  - Box Hantaran
                </li>
              </ul>
              <ul class="flex flex-col gap-2">
                <li class="text-[#1B2023] font-medium text-base">- Make up</li>
                <li class="text-[#1B2023] font-medium text-base">- Photo</li>
              </ul>
            </div>
            <div class="flex line-through custom-strikethrough">
              <p class="text-xs font-medium text-[#21252F]">Rp</p>
              <h4 class="font-medium text-lg text-[#21252F]">2.800.000</h4>
            </div>
            <div class="flex">
              <p class="text-lg font-bold text-[#21252F]">Rp</p>
              <h4 class="font-bold text-3xl text-[#21252F]">1.800.000</h4>
            </div>
          </div>
          <button
            class="bg-[#D6D2B1] text-[#6D5119] font-bold text-sm text-center w-[200px] h-[50px]"
          >
            Booking Sekarang
          </button>
        </div>
      </section>
      <!-- Recent Client -->
      <section class="w-full py-16 bg-[#E9E8C9] relative md:min-h-[600px]">
        <img
          src="./image/recent-client/bg_client.png"
          alt="Background"
          class="w-full h-auto absolute object-contain"
        />
        <div class="max-w-[1100px] mx-auto flex flex-col gap-10 px-6 lg:px-0">
          <p class="text-[#7A7A7A] font-semibold text-xln text-center">
            Recent Client
          </p>
          <img
            src="./image/recent-client/testimoni_1.png"
            alt="Background"
            class="w-full h-full lg:w-auto lg:h-auto object-contain"
          />
        </div>
      </section>
      <!-- Footer -->
      <footer class="flex flex-col">
        <section class="w-full bg-[#1B2023] py-16">
          <div
            class="max-w-[1100px] mx-auto flex flex-col md:flex-row gap-6 lg:gap-0 justify-between flex-wrap px-6 lg:px-0"
          >
            <div class="flex flex-col gap-10">
              <img
                src="./image/footer/logo.png"
                alt="Logo"
                class="w-[200px] h-auto object-cover"
              />
              <div class="flex flex-col gap-4">
                <h4 class="text-2xl font-semibold text-white">Contact</h4>
                <div class="flex flex-col gap-3">
                  <div class="flex items-center gap-1">
                    <svg
                      width="19"
                      height="20"
                      viewBox="0 0 19 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_145_2400)">
                        <path
                          d="M13.5613 11.8623C13.3356 11.7498 12.255 11.1873 12.0531 11.0998C11.8513 11.0123 11.7088 10.9873 11.5544 11.2248C11.4 11.4623 10.9844 11.9748 10.8538 12.1373C10.7231 12.2998 10.6044 12.3123 10.3788 12.1373C9.73073 11.8635 9.13222 11.4745 8.6094 10.9873C8.13612 10.5183 7.73545 9.97418 7.4219 9.3748C7.29127 9.1498 7.4219 9.0248 7.5169 8.8998C7.6119 8.7748 7.73065 8.6373 7.8494 8.4998C7.93624 8.38089 8.00809 8.25064 8.06315 8.1123C8.09261 8.04797 8.10791 7.97747 8.10791 7.90605C8.10791 7.83463 8.09261 7.76414 8.06315 7.6998C8.06315 7.5873 7.5644 6.4498 7.3744 5.9873C7.1844 5.5248 7.01815 5.5873 6.88752 5.5873H6.41252C6.18625 5.59659 5.97271 5.69998 5.81877 5.8748C5.5703 6.12439 5.37348 6.42532 5.24066 6.75872C5.10784 7.09212 5.04187 7.45081 5.0469 7.8123C5.10764 8.69978 5.41764 9.54821 5.93752 10.2498C6.89153 11.7416 8.19671 12.9475 9.72565 13.7498C10.2481 13.9873 10.6519 14.1248 10.9725 14.2373C11.4228 14.3805 11.8987 14.4105 12.3619 14.3248C12.6696 14.2591 12.9611 14.1276 13.2185 13.9383C13.4759 13.7491 13.6936 13.5063 13.8581 13.2248C13.9951 12.8772 14.0402 12.4972 13.9888 12.1248C13.9294 12.0373 13.7869 11.9748 13.5613 11.8623Z"
                          fill="#A0A0A0"
                          stroke="#A0A0A0"
                          stroke-width="0.692308"
                        />
                        <path
                          d="M15.7819 3.34983C14.9606 2.47718 13.9817 1.78649 12.9028 1.31847C11.8239 0.850459 10.6669 0.614608 9.5 0.62483C7.95422 0.633345 6.43762 1.06862 5.10167 1.88718C3.76571 2.70574 2.65717 3.87894 1.88674 5.2896C1.11632 6.70026 0.710989 8.29901 0.711231 9.92616C0.711473 11.5533 1.11728 13.1519 1.88812 14.5623L0.700623 19.3748L5.37937 18.1248C6.67284 18.8657 8.12244 19.2526 9.595 19.2498H9.5C11.255 19.2619 12.9737 18.7234 14.4368 17.7031C15.9 16.6829 17.0413 15.227 17.7152 13.5212C18.3892 11.8154 18.5652 9.93696 18.2209 8.12543C17.8765 6.31389 17.0274 4.65136 15.7819 3.34983ZM9.5 17.6498C8.18253 17.6509 6.88955 17.275 5.75937 16.5623L5.49812 16.3998L2.71937 17.1623L3.45562 14.3123L3.28937 14.0248C2.34098 12.4171 1.98622 10.4989 2.2924 8.6341C2.59859 6.7693 3.54441 5.08769 4.95041 3.90831C6.35641 2.72893 8.12477 2.13385 9.91997 2.23598C11.7152 2.3381 13.4123 3.13032 14.6894 4.46233C15.374 5.1772 15.9166 6.02834 16.2857 6.96617C16.6547 7.904 16.8427 8.90975 16.8387 9.92483C16.8356 11.9726 16.0614 13.9356 14.6858 15.3836C13.3102 16.8316 11.4454 17.6465 9.5 17.6498Z"
                          fill="#A0A0A0"
                          stroke="#A0A0A0"
                          stroke-width="0.692308"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_145_2400">
                          <rect width="19" height="20" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                    <p class="text-[#A0A0A0] font-light text-sm">
                      0811 1117 222 (Siswoko)
                    </p>
                  </div>
                  <div class="flex items-center gap-1">
                    <svg
                      width="19"
                      height="20"
                      viewBox="0 0 19 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_145_2400)">
                        <path
                          d="M13.5613 11.8623C13.3356 11.7498 12.255 11.1873 12.0531 11.0998C11.8513 11.0123 11.7088 10.9873 11.5544 11.2248C11.4 11.4623 10.9844 11.9748 10.8538 12.1373C10.7231 12.2998 10.6044 12.3123 10.3788 12.1373C9.73073 11.8635 9.13222 11.4745 8.6094 10.9873C8.13612 10.5183 7.73545 9.97418 7.4219 9.3748C7.29127 9.1498 7.4219 9.0248 7.5169 8.8998C7.6119 8.7748 7.73065 8.6373 7.8494 8.4998C7.93624 8.38089 8.00809 8.25064 8.06315 8.1123C8.09261 8.04797 8.10791 7.97747 8.10791 7.90605C8.10791 7.83463 8.09261 7.76414 8.06315 7.6998C8.06315 7.5873 7.5644 6.4498 7.3744 5.9873C7.1844 5.5248 7.01815 5.5873 6.88752 5.5873H6.41252C6.18625 5.59659 5.97271 5.69998 5.81877 5.8748C5.5703 6.12439 5.37348 6.42532 5.24066 6.75872C5.10784 7.09212 5.04187 7.45081 5.0469 7.8123C5.10764 8.69978 5.41764 9.54821 5.93752 10.2498C6.89153 11.7416 8.19671 12.9475 9.72565 13.7498C10.2481 13.9873 10.6519 14.1248 10.9725 14.2373C11.4228 14.3805 11.8987 14.4105 12.3619 14.3248C12.6696 14.2591 12.9611 14.1276 13.2185 13.9383C13.4759 13.7491 13.6936 13.5063 13.8581 13.2248C13.9951 12.8772 14.0402 12.4972 13.9888 12.1248C13.9294 12.0373 13.7869 11.9748 13.5613 11.8623Z"
                          fill="#A0A0A0"
                          stroke="#A0A0A0"
                          stroke-width="0.692308"
                        />
                        <path
                          d="M15.7819 3.34983C14.9606 2.47718 13.9817 1.78649 12.9028 1.31847C11.8239 0.850459 10.6669 0.614608 9.5 0.62483C7.95422 0.633345 6.43762 1.06862 5.10167 1.88718C3.76571 2.70574 2.65717 3.87894 1.88674 5.2896C1.11632 6.70026 0.710989 8.29901 0.711231 9.92616C0.711473 11.5533 1.11728 13.1519 1.88812 14.5623L0.700623 19.3748L5.37937 18.1248C6.67284 18.8657 8.12244 19.2526 9.595 19.2498H9.5C11.255 19.2619 12.9737 18.7234 14.4368 17.7031C15.9 16.6829 17.0413 15.227 17.7152 13.5212C18.3892 11.8154 18.5652 9.93696 18.2209 8.12543C17.8765 6.31389 17.0274 4.65136 15.7819 3.34983ZM9.5 17.6498C8.18253 17.6509 6.88955 17.275 5.75937 16.5623L5.49812 16.3998L2.71937 17.1623L3.45562 14.3123L3.28937 14.0248C2.34098 12.4171 1.98622 10.4989 2.2924 8.6341C2.59859 6.7693 3.54441 5.08769 4.95041 3.90831C6.35641 2.72893 8.12477 2.13385 9.91997 2.23598C11.7152 2.3381 13.4123 3.13032 14.6894 4.46233C15.374 5.1772 15.9166 6.02834 16.2857 6.96617C16.6547 7.904 16.8427 8.90975 16.8387 9.92483C16.8356 11.9726 16.0614 13.9356 14.6858 15.3836C13.3102 16.8316 11.4454 17.6465 9.5 17.6498Z"
                          fill="#A0A0A0"
                          stroke="#A0A0A0"
                          stroke-width="0.692308"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_145_2400">
                          <rect width="19" height="20" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                    <p class="text-[#A0A0A0] font-light text-sm">
                      0815 1443 5114 (Adm Pusat)
                    </p>
                  </div>
                  <div class="flex items-center gap-1">
                    <svg
                      width="19"
                      height="20"
                      viewBox="0 0 19 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_145_2400)">
                        <path
                          d="M13.5613 11.8623C13.3356 11.7498 12.255 11.1873 12.0531 11.0998C11.8513 11.0123 11.7088 10.9873 11.5544 11.2248C11.4 11.4623 10.9844 11.9748 10.8538 12.1373C10.7231 12.2998 10.6044 12.3123 10.3788 12.1373C9.73073 11.8635 9.13222 11.4745 8.6094 10.9873C8.13612 10.5183 7.73545 9.97418 7.4219 9.3748C7.29127 9.1498 7.4219 9.0248 7.5169 8.8998C7.6119 8.7748 7.73065 8.6373 7.8494 8.4998C7.93624 8.38089 8.00809 8.25064 8.06315 8.1123C8.09261 8.04797 8.10791 7.97747 8.10791 7.90605C8.10791 7.83463 8.09261 7.76414 8.06315 7.6998C8.06315 7.5873 7.5644 6.4498 7.3744 5.9873C7.1844 5.5248 7.01815 5.5873 6.88752 5.5873H6.41252C6.18625 5.59659 5.97271 5.69998 5.81877 5.8748C5.5703 6.12439 5.37348 6.42532 5.24066 6.75872C5.10784 7.09212 5.04187 7.45081 5.0469 7.8123C5.10764 8.69978 5.41764 9.54821 5.93752 10.2498C6.89153 11.7416 8.19671 12.9475 9.72565 13.7498C10.2481 13.9873 10.6519 14.1248 10.9725 14.2373C11.4228 14.3805 11.8987 14.4105 12.3619 14.3248C12.6696 14.2591 12.9611 14.1276 13.2185 13.9383C13.4759 13.7491 13.6936 13.5063 13.8581 13.2248C13.9951 12.8772 14.0402 12.4972 13.9888 12.1248C13.9294 12.0373 13.7869 11.9748 13.5613 11.8623Z"
                          fill="#A0A0A0"
                          stroke="#A0A0A0"
                          stroke-width="0.692308"
                        />
                        <path
                          d="M15.7819 3.34983C14.9606 2.47718 13.9817 1.78649 12.9028 1.31847C11.8239 0.850459 10.6669 0.614608 9.5 0.62483C7.95422 0.633345 6.43762 1.06862 5.10167 1.88718C3.76571 2.70574 2.65717 3.87894 1.88674 5.2896C1.11632 6.70026 0.710989 8.29901 0.711231 9.92616C0.711473 11.5533 1.11728 13.1519 1.88812 14.5623L0.700623 19.3748L5.37937 18.1248C6.67284 18.8657 8.12244 19.2526 9.595 19.2498H9.5C11.255 19.2619 12.9737 18.7234 14.4368 17.7031C15.9 16.6829 17.0413 15.227 17.7152 13.5212C18.3892 11.8154 18.5652 9.93696 18.2209 8.12543C17.8765 6.31389 17.0274 4.65136 15.7819 3.34983ZM9.5 17.6498C8.18253 17.6509 6.88955 17.275 5.75937 16.5623L5.49812 16.3998L2.71937 17.1623L3.45562 14.3123L3.28937 14.0248C2.34098 12.4171 1.98622 10.4989 2.2924 8.6341C2.59859 6.7693 3.54441 5.08769 4.95041 3.90831C6.35641 2.72893 8.12477 2.13385 9.91997 2.23598C11.7152 2.3381 13.4123 3.13032 14.6894 4.46233C15.374 5.1772 15.9166 6.02834 16.2857 6.96617C16.6547 7.904 16.8427 8.90975 16.8387 9.92483C16.8356 11.9726 16.0614 13.9356 14.6858 15.3836C13.3102 16.8316 11.4454 17.6465 9.5 17.6498Z"
                          fill="#A0A0A0"
                          stroke="#A0A0A0"
                          stroke-width="0.692308"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_145_2400">
                          <rect width="19" height="20" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                    <p class="text-[#A0A0A0] font-light text-sm">
                      085775178097 (Cab.Bogor)
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-col gap-4">
              <h3 class="font-semibold text-2xl text-white">Services</h3>
              <ul class="flex flex-col gap-3">
                <li class="text-[#A0A0A0] font-light text-sm">Wedding</li>
                <li class="text-[#A0A0A0] font-light text-sm">Akad</li>
                <li class="text-[#A0A0A0] font-light text-sm">Lamaran</li>
                <li class="text-[#A0A0A0] font-light text-sm">Khitan</li>
                <li class="text-[#A0A0A0] font-light text-sm">Cathering</li>
                <li class="text-[#A0A0A0] font-light text-sm">
                  Tenda & Dekorasi
                </li>
                <li class="text-[#A0A0A0] font-light text-sm">
                  Entertaintment
                </li>
                <li class="text-[#A0A0A0] font-light text-sm">MUA</li>
                <li class="text-[#A0A0A0] font-light text-sm">Dokumentasi</li>
                <li class="text-[#A0A0A0] font-light text-sm">Campursari</li>
              </ul>
            </div>
            <div class="flex flex-col gap-6">
              <div class="flex flex-col gap-4">
                <h3 class="text-white font-semibold text-2xl">Our Location</h3>
                <div class="flex flex-col gap-3">
                  <h4 class="text-[#A0A0A0] font-bold text-xl">
                    New Suponyono Pusat
                  </h4>
                  <p class="text-[#A0A0A0] font-light text-sm lowercase">
                    PONDOK UNGU PERMAI SEKTOR V BLOK i15 No. 12A
                  </p>
                </div>
                <div class="flex flex-col gap-3">
                  <h4 class="text-[#A0A0A0] font-bold text-xl">
                    New Suponyono Cab.Bogor
                  </h4>
                  <p class="text-[#A0A0A0] font-light text-sm lowercase">
                    PONDOK UNGU PERMAI SEKTOR V BLOK i15 No. 12A
                  </p>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <h3 class="text-white font-semibold text-2xl">Follow Us</h3>
                <div class="flex items-center gap-3">
                  <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_145_2420)">
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M11 16.5C14.0376 16.5 16.5 14.0376 16.5 11C16.5 7.96243 14.0376 5.5 11 5.5C7.96243 5.5 5.5 7.96243 5.5 11C5.5 14.0376 7.96243 16.5 11 16.5ZM11 14.6667C13.025 14.6667 14.6667 13.025 14.6667 11C14.6667 8.97496 13.025 7.33333 11 7.33333C8.97496 7.33333 7.33333 8.97496 7.33333 11C7.33333 13.025 8.97496 14.6667 11 14.6667Z"
                        fill="#A0A0A0"
                      />
                      <path
                        d="M16.5 4.58301C15.9937 4.58301 15.5833 4.99342 15.5833 5.49967C15.5833 6.00593 15.9937 6.41634 16.5 6.41634C17.0063 6.41634 17.4166 6.00593 17.4166 5.49967C17.4166 4.99342 17.0063 4.58301 16.5 4.58301Z"
                        fill="#A0A0A0"
                      />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M1.51612 3.91956C0.916656 5.09607 0.916656 6.63622 0.916656 9.71651V12.2832C0.916656 15.3634 0.916656 16.9036 1.51612 18.0801C2.04342 19.115 2.88481 19.9564 3.91971 20.4837C5.09623 21.0832 6.63637 21.0832 9.71666 21.0832H12.2833C15.3636 21.0832 16.9038 21.0832 18.0802 20.4837C19.1152 19.9564 19.9566 19.115 20.4838 18.0801C21.0833 16.9036 21.0833 15.3634 21.0833 12.2832V9.71651C21.0833 6.63622 21.0833 5.09607 20.4838 3.91956C19.9566 2.88466 19.1152 2.04327 18.0802 1.51597C16.9038 0.916504 15.3636 0.916504 12.2833 0.916504H9.71666C6.63637 0.916504 5.09623 0.916504 3.91971 1.51597C2.88481 2.04327 2.04342 2.88466 1.51612 3.91956ZM12.2833 2.74984H9.71666C8.14626 2.74984 7.07872 2.75127 6.25356 2.81868C5.44979 2.88435 5.03876 3.00338 4.75203 3.14948C4.0621 3.50102 3.50117 4.06194 3.14963 4.75187C3.00353 5.03861 2.8845 5.44964 2.81883 6.25341C2.75142 7.07857 2.74999 8.14611 2.74999 9.71651V12.2832C2.74999 13.8536 2.75142 14.9211 2.81883 15.7462C2.8845 16.5501 3.00353 16.9611 3.14963 17.2478C3.50117 17.9377 4.0621 18.4986 4.75203 18.8502C5.03876 18.9963 5.44979 19.1154 6.25356 19.181C7.07872 19.2484 8.14626 19.2498 9.71666 19.2498H12.2833C13.8538 19.2498 14.9212 19.2484 15.7464 19.181C16.5502 19.1154 16.9613 18.9963 17.248 18.8502C17.9379 18.4986 18.4988 17.9377 18.8503 17.2478C18.9964 16.9611 19.1155 16.5501 19.1812 15.7462C19.2485 14.9211 19.25 13.8536 19.25 12.2832V9.71651C19.25 8.14611 19.2485 7.07857 19.1812 6.25341C19.1155 5.44964 18.9964 5.03861 18.8503 4.75187C18.4988 4.06194 17.9379 3.50102 17.248 3.14948C16.9613 3.00338 16.5502 2.88435 15.7464 2.81868C14.9212 2.75127 13.8538 2.74984 12.2833 2.74984Z"
                        fill="#A0A0A0"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_145_2420">
                        <rect width="22" height="22" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                  <p class="text-[#A0A0A0] font-light text-sm lowercase">
                    @New_Soponyono
                  </p>
                </div>
                <div class="flex items-center gap-3">
                  <svg
                    width="18"
                    height="20"
                    viewBox="0 0 18 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M13.8218 3.1344C13.0887 2.29394 12.648 1.19805 12.648 0H11.7293C11.9659 1.3095 12.7454 2.43326 13.8218 3.1344Z"
                      fill="#A0A0A0"
                    />
                    <path
                      d="M5.3218 9.90462C3.73038 9.90462 2.43591 11.2002 2.43591 12.7929C2.43591 13.9028 3.06691 14.8686 3.98556 15.3515C3.64223 14.8779 3.43808 14.2975 3.43808 13.6659C3.43808 12.0732 4.73255 10.7776 6.324 10.7776C6.62093 10.7776 6.90856 10.8286 7.1777 10.9122V7.40174C6.89927 7.36455 6.61628 7.34131 6.324 7.34131C6.27294 7.34131 6.22654 7.34596 6.1755 7.34596V10.0392C5.90176 9.95562 5.61873 9.90462 5.3218 9.90462Z"
                      fill="#A0A0A0"
                    />
                    <path
                      d="M16.4245 4.67627V7.34633C14.6429 7.34633 12.9912 6.7752 11.6456 5.8093V12.7979C11.6456 16.2853 8.8108 19.1272 5.32172 19.1272C3.97621 19.1272 2.7235 18.7 1.69812 17.9802C2.8534 19.22 4.50049 20.0002 6.32392 20.0002C9.8083 20.0002 12.6478 17.1629 12.6478 13.6709V6.6823C13.9933 7.6482 15.645 8.21929 17.4267 8.21929V4.78312C17.0787 4.78312 16.7446 4.74593 16.4245 4.67627Z"
                      fill="#A0A0A0"
                    />
                    <path
                      d="M11.6456 12.7977V5.80911C12.9912 6.77501 14.6429 7.34614 16.4245 7.34614V4.67608C15.3945 4.45788 14.4899 3.90063 13.8218 3.1344C12.7454 2.43326 11.9704 1.3095 11.7245 0H9.2098L9.2051 13.7775C9.1495 15.3192 7.8782 16.5591 6.32393 16.5591C5.35884 16.5591 4.50977 16.0808 3.98085 15.3564C3.06219 14.8688 2.4312 13.9076 2.4312 12.7977C2.4312 11.205 3.72567 9.9094 5.31708 9.9094C5.61402 9.9094 5.90168 9.9605 6.17079 10.0441V7.35079C2.75598 7.42509 0 10.2298 0 13.6707C0 15.3331 0.64492 16.847 1.69812 17.98C2.7235 18.6998 3.97621 19.127 5.32172 19.127C8.8061 19.127 11.6456 16.2851 11.6456 12.7977Z"
                      fill="#A0A0A0"
                    />
                  </svg>
                  <p class="text-[#A0A0A0] font-light text-sm lowercase">
                    @New_Soponyono
                  </p>
                </div>
                <div class="flex items-center gap-3">
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_145_2443)">
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.98844 12.5861V6.9743C9.98064 7.91173 11.5236 8.81731 13.3485 9.79364C11.8433 10.6283 9.98064 11.5649 7.98844 12.5861ZM19.091 4.18328C18.7474 3.73052 18.1617 3.37809 17.5381 3.26141C15.7053 2.91336 4.27099 2.91237 2.43915 3.26141C1.93911 3.35515 1.49384 3.58173 1.11133 3.93377C-0.500363 5.42967 0.00466618 13.4517 0.393147 14.7512C0.556507 15.3136 0.76769 15.7193 1.03365 15.9855C1.37631 16.3376 1.84547 16.58 2.38436 16.6887C3.89345 17.0008 11.668 17.1753 17.5062 16.7355C18.0441 16.6418 18.5202 16.3916 18.8958 16.0246C20.3859 14.5347 20.2843 6.06213 19.091 4.18328Z"
                        fill="#A0A0A0"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_145_2443">
                        <rect width="20" height="20" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                  <p class="text-[#A0A0A0] font-light text-sm lowercase">
                    @New_Soponyono
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section
          class="w-full h-[75px] bg-white flex items-center justify-center px-6 lg:px-0"
        >
          <p class="text-[#1B20234D] text-opacity-30 font-light text-center">
            Copyright &copy; 2024 New Suponyono. All Rights Reserved
          </p>
        </section>
      </footer>
    </main>

</body>
</html>