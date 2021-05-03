<!-- View for displaying the quote list to the user -->

<?php include('header.php'); ?>

<!-- Put Drop down menu selections author, category, or both  -->


<main>
    <h1>Quotes</h1>


    <form action="." method="get" id="make_selection">
    <input type="hidden" name = "action" value ="filter_quotes">
        <section id="dropmenus" class="dropmenus">
            <label>Category:</label>
            <select name="category_id">
                <option value="0">View All Categories</option>
                <?php foreach ($categories as $category) : ?>
                <?php if ($category['ID'] == $category_id) { ?>
                <option value="<?= $category['ID']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $category['ID']; ?>">
                    <?php } ?>
                    <?= $category['categories']; ?>
                </option>
                <?php endforeach; ?>
            </select>


            <label>Author:</label>
            <select name="author_id">
                <option value="0">View All Authors</option>
                <?php foreach ($authors as $author) : ?>
                <?php if ($author['ID'] == $author_id) { ?>
                <option value="<?= $author['ID']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $author['ID']; ?>">
                    <?php } ?>
                    <?= $author['author']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Submit" class="button blue button-slim">
        </section>
        </form>


        <!-- Building Data Table --> 
        <table class="table table-dark table-bordered">
    <thead>
        <tr>
        <th scope="col">Quote</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($quotes as $quote) : ?>
        <tr>
        <td><?php echo $quote['quote']; ?></td>
        <td><?php echo $quote['categories']; ?></td>
        <td><?php echo $quote['author']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</main>

<?php include('Location: "." '); ?>

<?php include('footer.php'); ?>
