<h1>Список категорий:</h1>
<ul>
<?php foreach ($categoriesList as $key => $category):?>
    <li><a href="<?=route('category.show', ['id' => $key])?>"><?=$category['name']?></a> </li>
<?php endforeach; ?>
</ul>
