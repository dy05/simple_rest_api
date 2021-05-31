<?php
include "functions/app.php";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $page = 'Liste des livres'; ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="font-sans px-4 pt-4 pb-8 flex bg-gray-100 text-gray-600">
<div class="container m-auto">
    <div class="flex flex-wrap xl:justify-between">
        <?php include_once "header.php"; ?>

        <div class="absolute top-2 right-2 p-3 text-md text-white bg-red-400 rounded-md leading-2" id="alertError">
            Veuillez patinter...
        </div>
 
        <div class="w-full md:w-8/12 flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="bg-green-500 text-white rounded-md mb-8 px-4 py-2 hidden" id="alertError">
                    </div>

                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ISBN
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Titre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom de l'auteur
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prix
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="tableData">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script>
    window.onload = function() {
        let $alertWait = document.getElementById('alertWait');
        let $alertError = document.getElementById('alertError');
        let $tableData = document.getElementById('tableData');
        if ($alertWait) {
            setTimeout(function() {
                $alertWait.remove();
            }, 2000);
        }

        if (tableData) {
            $.ajax({
                url: 'http://localhost:8000/api/books/',
                type: "GET",
            })
            .done(function ({data}) {
                for (let i = 0; i < data.length; i++) {
                tableData.innerHTML += `
                <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 capitalize">
                                    ` + data[i].isbn + `
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 capitalize">
                                ` + data[i].titre + `
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 capitalize">
                                ` + data[i].auteur + `
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-red-700 capitalize">
                                ` + data[i].price + `
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                ` + data[i].discovering_date + `
                                </span>
                            </td>
                            <td class="px-2 py-2 whitespace-nowraps text-right text-sm font-medium space-x-1 space-y-1 flex flex-col">
                                <a href="book_edit.php?isbn=` + data[i].isbn + `" class="text-white text-center px-2 py-1 rounded-md bg-indigo-600 hover:bg-indigo-800">Modifier</a>
                            </td>
                        </tr>`;
                    }
            })
            .fail(function (error) {
                alertError.classList.remove('hidden');
                alertError.innerText = 'Une erreur innatendue s\'est produite';
                alert('Une erreur innatendue s\'est produite');
                console.log(error);;
            });
        }
    }
</script>
</body>
</html>
