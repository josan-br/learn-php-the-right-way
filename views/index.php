<h1><?= $title ?></h1>
<p>Welcome to the home page!</p>

<hr />

<div>
    <?php if (! empty($invoice)): ?>
        Invoice ID: <?= htmlspecialchars($invoice['id'], ENT_QUOTES) ?>
        <br />
        Invoice Amount: <?= htmlspecialchars($invoice['amount'], ENT_QUOTES) ?>
        <br />
        User: <?= htmlspecialchars($invoice['full_name'], ENT_QUOTES) ?>
        <br />
    <?php endif ?>
    <div>