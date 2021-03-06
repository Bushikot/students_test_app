<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Students DB test application</title>
	<meta name="author" content="bushikot@gmail.com">
	<meta name="description" content="Students DB test application">
	<link href="components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>Students DB test app</h1>
			<a class="text-muted" href="mailto:bushikot@gmail.com">
				Кошечкин Денис
			</a>
		</div>

		<ul class="nav nav-tabs">
			<li class="nav active"><a href="#student-registration" data-toggle="tab">Регистрация</a></li>
			<li class="nav"><a href="#student-list" data-toggle="tab">Список студентов</a></li>
			<li class="nav"><a href="#top-ten-list" data-toggle="tab">10 лучших</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="student-registration">

				<br>
				<form id="registration_form">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Имя" id="fname" maxlength="25">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Фамилия" id="lname" maxlength="25">
					</div>

					<div class="form-group">
						<input type="text" class="form-control"  id="groupnumber" placeholder="Учебная группа">
					</div>

					<div class="row">
						<div class='col-sm-12'>
							<div class="form-group">
								<input type='text' class="form-control" placeholder="Дата рождения" id="birthday" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<input type="text" class="form-control"  placeholder="email" maxlength="50" id="email" />
					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="alert alert-success" role="alert" id="success-alert" style="display: none"></div>
							<div class="alert alert-warning" role="alert" id="warning-alert" style="display: none"></div>
							<div class="alert alert-danger" role="alert" id="danger-alert" style="display: none"></div>
						</div>

						<div class="col-md-4">
							<button type="submit" class="btn btn-primary btn-lg pull-right">Добавить</button>
						</div>
					</div>
				</form>
			</div>

			<div class="tab-pane fade" id="student-list">
				<div class="container">
					<div class="row">
						<div class="form-group">
							<span id="students_list"></span>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="top-ten-list">
				<div class="container">
					<div class="row">
						<div class="form-group">
							<span id="top_ten_list"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Дополнительные данные о студенте</h4>
				</div>
				<div class="modal-body">
					<span id="student-additional-data"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="components/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="components/moment/min/moment.min.js"></script>
	<script type="text/javascript" src="components/moment/locale/ru.js"></script>
	<script type="text/javascript" src="components/bootstrap/bootstrap-built.js"></script>
	<script type="text/javascript" src="components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

	<script type="text/javascript">
		var fname, lname, groupnumber, birthday, email, student_list, student_additional_data, my_modal,
			top_ten_list, danger_alert, success_alert, warning_alert;

		$(function () {
			fname = $("#fname");
			lname = $("#lname");
			groupnumber = $("#groupnumber");
			birthday = $("#birthday");
			email = $("#email");
			student_list = $("#students_list");
			top_ten_list = $("#top_ten_list");
			my_modal = $("#myModal");
			student_additional_data = $("#student-additional-data");
			danger_alert = $("#danger-alert");
			success_alert = $("#success-alert");
			warning_alert = $("#warning-alert");

			birthday.datetimepicker({
				locale: 'ru',
				viewMode: 'years',
				format: 'YYYY.MM.DD'
			});

			$('#registration_form')[0].reset();

			getPaginatedList(1);
			getTopTen();
		});

		$('#registration_form').on("submit", function(event) {
			event.preventDefault();

			var formData = {
				'fname'      : fname.val(),
				'lname'      : lname.val(),
				'groupnumber': groupnumber.val(),
				'birthday'   : birthday.val(),
				'email'      : email.val()
			};

			callController('Main', 'registerStudentAction', student_additional_data, formData);
		});

		function getTopTen() {
			callController('Main', 'StudentTopTenAction', top_ten_list);
		}

		function getPaginatedList(page) {
			callController('Main', 'studentListAction', student_list, {
				page: page
			});
		}

		function alertBlink(myAlert, alertText) {
			myAlert.html(alertText);
			myAlert.slideDown();
			setTimeout(function() {
				myAlert.slideUp();
			}, 5000);
		}

		$("body").on("click", "ul.pagination > li > a", function() {
			getPaginatedList($(this).attr("href").substring(1));
		});

		$("body").on("click", "#student-more", function() {
			callController('Main', 'StudentMoreAction', student_additional_data, {
				studentid: $(this).attr("data")
			});

			my_modal.modal('show');
		});

		function callController(controller, action, place, data) {
			var ajaxSettings = {
				url: 'index.php?r={controller}/{action}'
					.replace('{controller}', controller)
					.replace('{action}', action),
				type: 'POST'
			};

			if (data !== undefined) {
				ajaxSettings.data = data;
			}

			var request = $.ajax(ajaxSettings)
				.done(function(answer) {
					place.html(answer);
					switch (answer) {
						case "query_successfully_executed":
							alertBlink(success_alert, "Данные добавлены, спасибо!");
							$('#registration_form')[0].reset();
							break
						case "error_fields_are_not_set":
							alertBlink(warning_alert, "Заполните все поля!");
							break
					}
				})
				.fail(function() {
					alert('Что-то пошло не так');
				});
		}

	</script>
</body>
</html>