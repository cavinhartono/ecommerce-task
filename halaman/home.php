<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/output.css">
  <title>Home</title>
</head>

<body>
  <main class="container">
    <header class="fixed top-0 left-0 w-full px-24 py-6 flex justify-between items-center shadow-none transition-all -translate-y-0 z-10">
      <h1 class="font-medium text-lg">Clothing</h1>
      <ul class="flex gap-6">
        <li class="relative active"><a href="#">Home</a></li>
        <li class="relative"><a href="#">Products</a></li>
        <li class="relative"><a href="#">Transaction</a></li>
      </ul>
      <ul class="flex gap-6">
        <li class="text-gray-800">
          <a href="#">
            <span class="w-6 h-6"></span>
          </a>
        </li>
        <li class="text-gray-800">
          <a href="#">
            <span class="w-6 h-6"></span>
          </a>
        </li>
      </ul>
    </header>
    <div class="relative w-full h-5/6 bg-gradient-to-b from-black to-transparent flex justify-center items-center">
      <img src="" alt="" class="absolute w-full h-full object-cover">
      <h1 class="font-serif text-black text-2xl"></h1>
    </div>
  </main>
  <script>
    const links = document.querySelectorAll("header ul li");

    function activeLink() {
      links.forEach(link => link.classList.remove("active"));
      this.classList.add("active")
    }

    links.forEach((link) => link.addEventListener('click', activeLink));

    const header = document.querySelector('header');

    function scrolled() {
      if (window.pageYOffset > 100) {
        header.classList.add('-translate-y-20', 'shadow-md');
      } else {
        header.classList.remove('-translate-y-20', 'shadow-md');
      }
    }

    window.addEventListener('scroll', scrolled);
  </script>
</body>

</html>