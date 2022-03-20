<h1>Artículos</h1>
<table id="list" class="display table mb-0 dataTable no-footer">
    <thead>
        <tr>
            <th>Título</th>
        </tr>
    </thead>  
    <tbody>
        <?php foreach ($posts as $post) {
            $idPost = htmlspecialchars($post->id, ENT_QUOTES, 'UTF-8');
            $postTitle = isset($post->title) ? htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8') : '';                                                                                                                 
        ?>
            <tr>
                <td><a href="<?php echo POSTS . '/' . $post->slug; ?>"><?php echo $postTitle; ?></a></td>
            </tr>
        <?php } ?>
    </tbody>                              
</table>