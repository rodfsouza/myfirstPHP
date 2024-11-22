<?php require '../src/Views/layout/header.php'; ?>

<div class="home-container">
    <h1>Welcome to Task Manager</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Tasks</h3>
                <p class="stat-number"><?= $taskStats->total ?></p>
            </div>
            <div class="stat-card">
                <h3>Completed Tasks</h3>
                <p class="stat-number"><?= $taskStats->completed ?></p>
            </div>
        </div>

        <div class="recent-tasks">
            <h2>Recent Tasks</h2>
            <?php if (!empty($recentTasks)): ?>
                <div class="tasks">
                    <?php foreach($recentTasks as $task): ?>
                        <div class="task-card">
                            <h3><?= htmlspecialchars($task->title) ?></h3>
                            <p><?= htmlspecialchars($task->description) ?></p>
                            <span class="status <?= $task->status ?>"><?= ucfirst($task->status) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No tasks yet. <a href="/tasks/create">Create your first task</a></p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="welcome-message">
            <p>Please <a href="/login">login</a> or <a href="/register">register</a> to manage your tasks.</p>
        </div>
    <?php endif; ?>
</div>

<?php require '../src/Views/layout/footer.php'; ?>