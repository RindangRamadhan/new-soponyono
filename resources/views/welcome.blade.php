<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/output.css') }}">

</head>
<body>
<main>
      <header class="h-[75px] w-full bg-bunker">
        <nav
          class="max-w-[1100px] mx-auto flex items-center justify-between h-full"
        >
          <img src="./image/logo.png" alt="Logo" class="w-[50px] h-auto" />
          <ul class="flex items-center gap-40 text-white">
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
        class="h-[calc(100vh_-_75px)] w-full bg-[url('/image/background_hero.png')] bg-cover relative"
      >
        <img
          src="./image/bg_overlay.png"
          alt="Background Overlay"
          class="h-[calc(100vh_-_75px)] w-full object-cover absolute"
        />
        <div
          class="flex items-center justify-between relative z-10 h-full gap-20 max-w-[1100px] mx-auto"
        >
          <img
            src="./image/hero_background.png"
            alt="background hero"
            class="w-[550px] h-[547px] object-cover"
          />
          <div class="flex flex-col gap-4">
            <p class="text-white font-light text-xl">We Are New Suponyono</p>
            <h1
              class="bg-[linear-gradient(180deg,_#FFDD9A_0%,_#D19A2E_100%)] text-8xl bg-clip-text text-transparent"
            >
              Wedding <br />
              Organizer,
            </h1>
            <div class="flex gap-10 mt-6">
              <div class="w-[113px] h-[1px] bg-white mt-2"></div>
              <p class="text-xl text-white font-light max-w-[323px]">
                Ciptakan Kenangan <br />
                Tak Terlupakan Bersama Kami
              </p>
            </div>
            <button
              class="text-west_coast font-bold text-sm bg-[linear-gradient(90deg,_#F4CD7F_0%,_#E0B052_100%)] text-center w-[261px] h-[60px]"
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
        <div class="max-w-[1100px] mx-auto flex justify-between">
          <div class="basis-6/12 flex flex-col gap-6">
            <p class="text-boulder font-semibold text-xl">About Us</p>
            <h4
              class="text-2xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#F4CC7E_0%,_#E1B152_100%)]"
            >
              PT SOPONYONO DADI KENCONO
            </h4>
            <h2
              class="text-4xl bg-clip-text text-transparent bg-[linear-gradient(180deg,_#F4CC7E_0%,_#E1B152_100%)]"
            >
              Merupakan Perusahaan yang bergerak di bidang Pelayanan dan jasa.
            </h2>
            <p class="text-lg font-light text-white">
              “New Soponyono” sudah berdiri sejak tahun 2009 Dan kami sudah
              berdiri selama 15 tahun. Kami berkomitmen untuk membuat event atau
              pesta yang tak terlupakan dan penuh makna. Maka dari itu kami
              hadir untuk membantu konsumen mewujudkan impian tersebut.
            </p>
          </div>
          <div class="basis-6/12 relative">
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
    </main>

</body>
</html>