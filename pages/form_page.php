<section class="form-section">

  <div class="form-header">
    <h2><?php echo $title; ?></h2>
    <p>Заповніть всі обов'язкові поля для створення нового ліда.</p>
  </div>

  <div class="card">
    <form action="/api/api.php" method="POST" id="leadForm" class="lead-form">

      <input type="hidden" name="action" value="addlead">

      <div class="form-group">
        <label for="firstName">Ім'я*</label>
        <input type="text" id="firstName" name="firstName" placeholder="John" required>
      </div>

      <div class="form-group">
        <label for="lastName">Прізвище*</label>
        <input type="text" id="lastName" name="lastName" placeholder="Doe" required>
      </div>

      <div class="form-group">
        <label for="phone">Телефон*</label>
        <input type="tel" id="phone" name="phone" placeholder="+44 7700 900000" required>
      </div>

      <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" id="email" name="email" placeholder="example@mail.com" required>
      </div>

      <div class="form-info">
        <small>* Всі поля є обов'язковими для заповнення.</small>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-submit">Надіслати</button>
      </div>
    </form>
  </div>

  <div id="responseMessage" style="margin-top: 20px;"></div>
</section>