<?php
include "functions/app.php";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $page = 'Ajouter un livre'; ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="font-sans px-4 pt-4 pb-8 flex bg-gray-100 text-gray-600">
<div class="container m-auto">
    <div class="flex flex-wrap xl:justify-between">
        <?php include_once "header.php"; ?>

        <div class="w-full md:w-8/12 bg-white rounded-lg shadow-lg xl:rounded-sm container h-auto relative p-4 xl:p-8">
            <div class="flex items-center px-4 xl:px-8">
                <img src="img/book.png" class="h-8 xl:h-16" alt="">
                <h1 class="text-xl xl:text-4xl uppercase text-gray-700">MyBook</h1>
            </div>
            <div class="w-full mt-8 px-4 xl:px-8 text-gray-500">
                <form action="" method="POST" id="addForm">
                    <?php if (!empty($errors)): ?>
                    <div class="bg-red-500 text-white rounded-md mb-8 px-4 py-2">
                        <ul class="space-y-1">
                            <?php foreach ($errors as $error): ?>
                                <li>
                                    <?= $error; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php elseif (isset($values['success'])): ?>
                    <div class="bg-green-500 text-white rounded-md mb-8 px-4 py-2">
                        <?= $values['success'] ?? ''; ?>
                    </div>
                    <?php endif; ?>

                    <div class="pb-2">
                        <label for="isbn" class="">ISBN du livre</label>
                        <input class="px-4 py-4 bg-gray-100 w-full text-sm placeholder-gray-500 border border-transparent focus:border-indigo-500"
                               placeholder="Isbn du livre" type="text" id="isbn" name="isbn" value="<?= $values['isbn'] ?? ''; ?>" required/>
                        <span id="isbn_error" class="bg-white shadow-lg text-red-500 font-semibold p-2 mt-1 hidden"></span>
                    </div>

                    <div class="pb-2 mt-2 relative">
                        <label for="titre" class="">Titre</label>
                        <input class="px-4 py-4 bg-gray-100 w-full text-sm placeholder-gray-500 border border-transparent focus:border-indigo-500"
                               placeholder="Titre" type="text" id="titre" name="titre" value="<?= $values['titre'] ?? ''; ?>" required/>
                        <span id="titre_error" class="bg-white shadow-lg text-red-500 font-semibold p-2 mt-1 hidden"></span>
                    </div>

                    <div class="pb-2 mt-2 relative">
                        <label for="auteur" class="">Nom de l'auteur</label>
                        <input class="px-4 py-4 bg-gray-100 w-full text-sm placeholder-gray-500 border border-transparent focus:border-indigo-500"
                               placeholder="Nom de l'auteur" type="text" id="auteur" name="auteur" value="<?= $values['auteur'] ?? ''; ?>" required/>
                        <span id="auteur_error" class="bg-white shadow-lg text-red-500 font-semibold p-2 mt-1 hidden"></span>
                    </div>

                    <div class="pb-2 mt-2 relative">
                        <label for="price" class="">Prix</label>
                        <input class="px-4 py-4 bg-gray-100 w-full text-sm placeholder-gray-500 border border-transparent focus:border-indigo-500"
                               placeholder="10000" type="number" id="price" name="price" value="<?= $values['price'] ?? ''; ?>" required/>
                        <span id="price_error" class="bg-white shadow-lg text-red-500 font-semibold p-2 mt-1 hidden"></span>
                    </div>


                    <div class="mt-2">
                        <label id="date">
                            Date de decouverte
                        </label>
                        <div class="bg-gray-100 relative w-full">
                            <input type="date" id="date" name="date" value="<?= $values['date'] ?? ''; ?>"
                                    class="w-full border-none bg-transparent py-4 pr-4 pl-8 relative z-10 focus:boder-none" required/>
                            <span class="absolute flex items-center justify-center w-4 h-full bottom-o top-0 left-2 z-0">
                                <img src="img/icon-calendar.png" class="h-4 mx-auto" alt="">
                            </span>
                        </div>
                        <span id="date_error" class="bg-white shadow-lg text-red-500 font-semibold p-2 mt-1 hidden"></span>
                    </div>

                    <div class="mt-16 w-full flex justify-end">
                        <button class="w-36 h-12 flex items-center justify-center px-4 py-4 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md uppercase" name="publish" type="submit">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script>
    window.onload = function() {
        let $formAdd = document.querySelector('#addForm');
        let isbn = document.querySelector("#addForm input[name='isbn']");
        let price = document.querySelector("#addForm input[name='price']");
        let titre = document.querySelector("#addForm input[name='titre']");
        let auteur = document.querySelector("#addForm input[name='auteur']");
        let date = document.querySelector("#addForm input[name='date']");

        let isbn_error = document.querySelector("#addForm #isbn_error");
        let price_error = document.querySelector("#addForm #price_error");
        let titre_error = document.querySelector("#addForm #titre_error");
        let auteur_error = document.querySelector("#addForm #auteur_error");
        let date_error = document.querySelector("#addForm #date_error");

        if ($formAdd, isbn, isbn_error, auteur, auteur_error, titre, titre_error, price, price_error, date, date_error) {
            $formAdd.addEventListener('submit', function (e) {
                e.preventDefault();

                isbn_error.innerHTML = '';
                price_error.innerHTML = '';
                titre_error.innerHTML = '';
                auteur_error.innerHTML = '';
                date_error.innerHTML = '';

                isbn_error.classList.add('hidden');
                price_error.classList.add('hidden');
                titre_error.classList.add('hidden');
                auteur_error.classList.add('hidden');
                date_error.classList.add('hidden');

                isbn_error.classList.remove('block');
                price_error.classList.remove('block');
                titre_error.classList.remove('block');
                auteur_error.classList.remove('block');
                date_error.classList.remove('block');
                console.log(date.value);

                if (isbn.value.length > 0 && price.value.length > 0 && titre.value.length > 0 && 
                    auteur.value.length > 0 && date.value.length > 8) {
                    $.ajax({
                        url: 'http://localhost:8000/api/books',
                        data: {
                            isbn: isbn.value,
                            auteur: auteur.value,
                            titre: titre.value,
                            price: price.value,
                            discovering_date: date.value,
                        },
                        type: "POST",
                    })
                    .done(function (data) {
                        alert('Ajoute avec succes')
                        isbn.value = '';
                        price.value = '';
                        auteur.value = '';
                        titre.value = '';
                        date.value = '';
                    })
                    .fail(function (error) {
                        console.log(error);
                        console.log(error.responseJSON);
                        if (error.responseJSON) {
                            let error_string = '';
                            if (error.responseJSON.isbn) {
                                if (error.responseJSON.isbn.Min) {
                                    error_string = 'Le champ est inferieur a 3';
                                }
                                else if (error.responseJSON.isbn.Unique) {
                                    error_string = 'L\'isbn est deja utilise'
                                } else {
                                    error_string = 'Le champ est obligatoire et doit etre correct';
                                }

                                isbn_error.innerHTML = error_string;
                                isbn_error.classList.remove('hidden');
                                isbn_error.classList.add('block');
                            }

                            if (error.responseJSON.titre) {
                                if (error.responseJSON.titre.Min) {
                                    error_string = 'Le champ est inferieur a 3';
                                } else {
                                    error_string = 'Le champ est obligatoire et doit etre correct';
                                }

                                titre_error.innerHTML = error_string;
                                titre_error.classList.remove('hidden');
                                titre_error.classList.add('block');
                            }

                            if (error.responseJSON.price) {
                                if (error.responseJSON.price.Min) {
                                    error_string = 'Le prix doit etre superieur 10';
                                } else {
                                    error_string = 'Le champ est obligatoire et doit etre correct';
                                }

                                price_error.innerHTML = error_string;
                                price_error.classList.remove('hidden');
                                price_error.classList.add('block');
                            }

                            if (error.responseJSON.auteur) {
                                if (error.responseJSON.auteur.Min) {
                                    error_string = 'Le champ est inferieur a 3';
                                } else {
                                    error_string = 'Le champ est obligatoire et doit etre correct';
                                }

                                auteur_error.innerHTML = error_string;
                                auteur_error.classList.remove('hidden');
                                auteur_error.classList.add('block');
                            }

                            if (error.responseJSON.discovering_date) {
                                if (error.responseJSON.discovering_date.DateFormat) {
                                    error_string = 'Le champ est incorrect';
                                } else {
                                    error_string = 'Le champ est obligatoire et doit etre correct';
                                }
                                date_error.innerHTML = error_string;
                                date_error.classList.remove('hidden');
                                date_error.classList.add('block');
                            }
                        }
                    });
                } else {
                    alert ('Vous n\'avez pas remplir tous les champs')
                }
                
            });
        }
    }

</script>
</body>
</html>
