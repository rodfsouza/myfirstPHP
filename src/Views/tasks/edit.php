<?php require '../src/Views/layout/header.php'; ?>

<div class="task-form">
    <h1>Edit Task</h1>
    
    <form action="/tasks/edit?id=<?= $task->id ?>" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($task->title) ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($task->description) ?></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pending" <?= $task->status === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="in_progress" <?= $task->status === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="completed" <?= $task->status === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>

        <button type="submit" class="button">Update Task</button>
        <a href="/tasks" class="button">Cancel</a>
    </form>
</div>

<?php require '../src/Views/layout/footer.php'; ?>