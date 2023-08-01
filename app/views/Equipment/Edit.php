<style>
.exclusao-ativa img { opacity: 0.3;} 
</style>
<h1>
    <?php echo (isset($equipments->equipments_id)) ? 'Editar Equipamento' : 'Adicionar Equipamento'; ?>
</h1>

<form action="<?php echo URL_BASE . "Equipment/save" ?>" method="POST" enctype="multipart/form-data">

    <div class="row">
        <div class="form-group col-lg-6 col-12 mb-2">
           <?php if (isset($equipments->img1) && $equipments->img1 != '') { ?>
                <label class="container-imagem" for="img1">
                    <img id="preview"  width="250" height="250"
                        src="<?php echo (isset($equipments->img1)) ? (URL_IMAGEM . $equipments->img1) : ''; ?>">
                </label>
                <div class="image-buttons mt-1 mb-1">
                   <button type="button" class="btn btn-primary btn-edit" data-target="img1">Editar</button>
                   <button type="button" class="btn btn-danger btn-delete ms-2" data-target="remove_img">Excluir</button>
                   <input type="checkbox" class="form-check-input visually-hidden" id="remove_img" name="remove_img"
                       value="1">
                </div>
            <?php } else { ?>
                <label class="container-imagem" for="img1">
                    <svg class="bd-placeholder-img " width="250" height="250" role="img" focusable="false">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="10%" y="50%" fill="#dee2e6" dy=".3em">Carregue uma imagem</text>
                    </svg>
                </label>
            <?php } ?>
            <input type="file" class="form-control-file visually-hidden" id="img1" name="img1">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-6 col-12 mb-2">
           <?php if (isset($equipments->img2) && $equipments->img2 != '') { ?>
                <label class="container-imagem" for="img2">
                    <img id="preview"  width="250" height="250"
                        src="<?php echo (isset($equipments->img2)) ? (URL_IMAGEM . $equipments->img2) : ''; ?>">
                </label>
                <div class="image-buttons mt-1 mb-1">
                   <button type="button" class="btn btn-primary btn-edit" data-target="img2">Editar</button>
                   <button type="button" class="btn btn-danger btn-delete ms-2" data-target="remove_img">Excluir</button>
                   <input type="checkbox" class="form-check-input visually-hidden" id="remove_img" name="remove_img"
                       value="1">
                </div>
            <?php } else { ?>
                <label class="container-imagem" for="img2">
                    <svg class="bd-placeholder-img " width="250" height="250" role="img" focusable="false">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="10%" y="50%" fill="#dee2e6" dy=".3em">Carregue uma imagem</text>
                    </svg>
                </label>
            <?php } ?>
            <input type="file" class="form-control-file visually-hidden" id="img2" name="img2">
        </div>
    </div>

    <div class="form-group mb-2">
        <label for="equipments_name">Nome do Equipamento</label>
        <input type="text" class="form-control" id="equipments_name" name="equipments_name"
        value="<?php echo (isset($equipments->equipments_name)) ? $equipments->equipments_name : ''; ?>" required>
    </div>

    <div class="form-group mb-2">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5"
        required><?php echo (isset($equipments->description)) ? $equipments->description : ''; ?></textarea>
    </div>

    <div class="form-group mb-2">
        <label for="price_per_day">Preço por dia</label>
        <input type="number" class="form-control" id="price_per_day" name="price_per_day"
        value="<?php echo (isset($equipments->price_per_day)) ? $equipments->price_per_day : ''; ?>" required>
    </div>

    <div class="form-group mb-2">
        <label for="availabilities_id">Disponibilidade</label>
        <select class="form-select" aria-label="Default select example" name="availabilities_id">
            <?php foreach ($availabilities as $item) {
                echo "<option value='$item->availabilities_id'". ($item->availabilities_id == $equipments->availabilities_id ? "selected" : "") . ">$item->availabilities_name</option>";
            } ?>
        </select>
    </div>


    <input type="hidden" name="equipments_id" value="<?php echo (isset($equipment->equipments_id)) ? $equipment->equipments_id : NULL; ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="row">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        <div class="col-auto">
            <a href="<?php echo URL_BASE . "Equipment" ?>" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</form>
<script src="<?php echo URL_BASE ?>assets/js/inputImg.js"></script>
