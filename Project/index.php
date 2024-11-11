<?php include('layout/header.php'); ?>

<div class="conteiner mt-5 custom-container">
    <h1 class="custom-h1 mb-3 pb-3 pt-3">Descubra seu Signo</h1>
    <form id="signo-form" class="d-flex flex-column align-items-center justify-content-center gap-20 formulario"  method="POST" action="show_zodiac_sign.php">
        <div class="ab-3">
            <label for="data_nascimento" class="text-center w-100" class="form-label">Data de Nascimento</label> <br>
            <input type="date" class="form-control custom-input p-1" class="form-control" id="data_nascimento" name="data_nascimento"  required>
        </div>
        <button type="submit" class="btn btn-primary">Descobrir Signo</button>
    </form>
</div>

<?php include('layout/footer.php'); ?>