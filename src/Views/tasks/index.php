<?php require '../src/Views/layout/header.php'; ?>

<h1>Tasks</h1>
<a href="/tasks/create" class="button">Create New Task</a>

<div class="tasks">
    <?php foreach($tasks as $task): ?>
        <div class="task-card">
            <h3><?= htmlspecialchars($task->title) ?></h3>
            <p><?= htmlspecialchars($task->description) ?></p>
            <div class="task-actions">
                <a href="/tasks/edit?id=<?= $task->id ?>" class="button">Edit</a>
                <form action="/tasks/delete" method="POST" class="inline">
                    <input type="hidden" name="id" value="<?= $task->id ?>">
                    <button type="submit" class="button delete">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require '../src/Views/layout/footer.php'; ?>