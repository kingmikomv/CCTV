
<!DOCTYPE html>
<html lang="en">

<x-Frontend.head />
<body class="index-page">

    <x-Frontend.navbar />

    <main class="main">

    
       <x-Frontend.show :produk="$produk"/>


       


        <!-- Contact Section -->
        <x-Frontend.contact />
    </main>

   <x-Frontend.footer />

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <x-Frontend.script />

</body>

</html>
