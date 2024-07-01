<?php include 'header.inc' ?>;
<?php include 'menu.inc' ?>;
    <title>EOI Management</title>
    <h1>EOI Management</h1>

    <form action="manage2.php" method="POST">
        <label for="query">Select Query:</label>
        <select name="query" id="query">
            <option value="all">List All EOIs</option>
            <!-- Add other options as needed -->
        </select>

        <!-- Add dropdown menu for sorting criteria -->
        <label for="sort_by">Sort By:</label>
        <select name="sort_by" id="sort_by">
            <option value="EOInumber">EOI Number</option>
            <option value="jobReference">Job Reference</option>
            <option value="firstName">First Name</option>
            <option value="dateSubmitted">Date Submitted</option>
            <!-- Add more options for other fields -->
        </select>

        <!-- Add sorting order option -->
        <label for="sort_order">Sort Order:</label>
        <select name="sort_order" id="sort_order">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <input type="submit" value="Submit">
    </form>

    <a href="manage.php" class="hover-link primary-button">Go back</a>
</body>
</html>
