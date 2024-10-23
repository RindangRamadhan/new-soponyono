const promoTrack = document.getElementById("promo-track");
const promoDots = document.querySelectorAll("#promoCarousel [data-index]");

promoDots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    promoTrack.style.transform = `translateX(-${index * 100}%)`;

    promoDots.forEach((d) => {
      d.innerHTML = ""; // Kosongkan innerHTML dari setiap dot
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
    });

    dot.classList.add(
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
    dot.appendChild(div);
  });
});
