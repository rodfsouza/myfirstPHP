<?php require '../src/Views/layout/header.php'; ?>

<div class="task-form">
    <h1>Create New Task</h1>
    
    <form action="/tasks/create" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="button">Create Task</button>
        <a href="/tasks" class="button">Cancel</a>
    </form>
</div>

<?php require '../src/Views/layout/footer.php'; ?>