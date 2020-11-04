<!DOCTYPE html>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<title>ISW-613 E-Shop</title>

<style>
body {
    margin-top: 40px;
    background-color: aqua;
}

section {
    background-color: lightgoldenrodyellow;
    border-radius: 30px;
    padding: 1.5rem 1.5rem 0 1.5rem;
}

.navbar {
    background: chocolate;
    height: 50px;
    border-radius: 30px;
    padding: 10px 20px;
    margin-bottom: 15px;
}

.navbar a {
    text-decoration: none;
    color: white;
    border-radius: 30px;
    margin-left: 20px;
}

.navbar a:last-child {
    margin-right: 20px
}

.navbar a:hover,
a:hover {
    color: orangered;
}

.navbar a:hover {
    transition: .5s;
}

footer {
    display: none;
}

@media (min-width: 1000px) {
    table {
        width: 100%;
        border-spacing: 0;
    }

    thead,
    tbody,
    tr,
    th,
    td {
        display: block;
    }

    thead tr {
        /* fallback */
        width: 97%;
        /* minus scroll bar width */
        width: calc(100% - 16px);
    }

    tr:after {
        /* clearing float */
        content: ' ';
        display: block;
        visibility: hidden;
        clear: both;
    }

    tbody {
        height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td,
    thead th {
        width: 20%;
        float: left;
    }

    footer {
        display: block;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2rem;
        text-align: right;
        color: black;
        background-color: white;
    }
}
</style>

<footer>
    <p>
        &copy 2020 Gustavo Espinoza C.
    </p>
</footer>