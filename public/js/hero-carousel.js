const carousel = document.getElementById("hero-track");
const dots = document.querySelectorAll("#heroCarousel [data-index]");

dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    // Mengatur transform untuk carousel
    carousel.style.transform = `translateX(-${index * carousel.offsetWidth}px)`;

    // Ubah warna dot aktif
    dots.forEach((d, i) => {
      // Reset semua dot
      d.innerHTML = "";
      d.classList.remove(
        "flex",
        "items-center",
        "justify-center",
        "!bg-transparent",
        "!bg-opacity-100",
        "border-[1.79px]",
        "border-[#C3C2AF]",
        "!h-[16.14px]",
        "!w-[16.14px]",
        "p-[2px]"
      );

      // Jika dot saat ini adalah yang aktif, tambahkan elemen baru
      if (i === index) {
        d.classList.add(
          "flex",
          "items-center",
          "justify-center",
          "!bg-transparent",
          "!bg-opacity-100",
          "border-[1.79px]",
          "border-[#C3C2AF]",
          "!h-[16.14px]",
          "!w-[16.14px]",
          "p-[2px]"
        );

        const div = document.createElement("div");
        div.classList.add(
          "min-h-[8.97px]",
          "min-w-[8.97px]",
          "rounded-full",
          "bg-[#C3C2AF]"
        );
        d.appendChild(div);
      }
    });
  });
});
