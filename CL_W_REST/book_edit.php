<?php include "functions/app.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $page = 'Afficher un livre'; ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
</head>
<div class="container m-auto">
    <div class="flex flex-wrap xl:justify-between">
        <?php include_once "header.php"; ?>

        <div class="w-full md:w-8/12 bg-white rounded-lg shadow-lg xl:rounded-sm container h-auto relative p-4 xl:p-8">
            <div class="flex items-center px-4 xl:px-8">
                <img src="img/book.png" class="h-8 xl:h-16" alt="">
                <h1 class="text-xl xl:text-4xl uppercase text-gray-700">MyBook</h1>
            </div>
            <div class="w-full mt-8 px-4 xl:px-8 text-gray-500">
                <div class="bg-red-500 text-white rounded-md mb-8 px-4 py-2" id="alertWait">
                    Veuillez patienter
                </div>
                <div class="bg-green-500 text-white rounded-md mb-8 px-4 py-2 hidden" id="alertError">
                </div>
                <div id="showData" class="hidden">
                    <div class="pb-2">
                        <label for="isbn" class="">ISBN du livre</label>
                        <div class="text-gray-500 p-2 font-semibold" id="isbn"></div>
                    </div>

                    <div class="pb-2 mt-2 relative">
                        <label for="titre" class="">Titre</label>
                        <div class="text-gray-500 p-2 font-semibold" id="titre"></div>
                    </div>

                    <div class="pb-2 mt-2 relative">
                        <label for="auteur" class="">Nom de l'auteur</label>
                        <div class="text-gray-500 p-2 font-semibold" id="auteur"></div>
                    </div>

                    <div class="pb-2 mt-2 relative">
                        <label for="price" class="">Prix</label>
                        <div class="text-gray-500 p-2 font-semibold" id="price"></div>
                    </div>


                    <div class="mt-2">
                        <label for="date">
                            Date de decouverte
                        </label>
                        <div class="text-gray-500 p-2 font-semibold" id="date"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script>
    window.onload = function() {
        let isbn = document.querySelector("#showData #isbn");
        let price = document.querySelector("#showData #price");
        let titre = document.querySelector("#showData #titre");
        let auteur = document.querySelector("#showData #auteur");
        let date = document.querySelector("#showData #date");
        
        let alertWait = document.querySelector("#alertWait");
        let alertError = document.querySelector("#alertError");
        let showData = document.querySelector("#showData");

        <?php if (isset($_GET['isbn'])): ?>

        if (isbn, auteur, titre, price, date) {
            $.ajax({
                url: 'http://localhost:8000/api/books/isbn/' + `<?= $_GET['isbn']; ?>`,
                type: "GET",
            })
            .done(function ({data}) {
                isbn.innerText = data.isbn;
                price.innerText = data.price;
                auteur.innerText = data.auteur;
                titre.innerText = data.titre;
                date.innerText = data.discovering_date;
                showData.classList.remove('hidden');
                alertWait.classList.add('hidden');
            })
            .fail(function (error) {
                alertWait.classList.add('hidden');
                alertError.classList.remove('hidden');
                alertError.innerText = 'Une erreur innatendue s\'est produite';
                alert('Une erreur innatendue s\'est produite');
                console.log(error);;
            });
        }

        <?php else: ?>
            alertWait.classList.add('hidden');
            alertError.classList.remove('hidden');
            alertError.innerText = 'Une erreur innatendue s\'est produite';
        <?php endif; ?>
    }

</script>
</body>
</html>
