<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; 

$db = dbAuthentificate();
$userParams = dbGetUserParamsById($db, $_SESSION['user_id']);
$groups = dbGetUserGroupsByUserId($db, $_SESSION['user_id']);
mysqli_close($db);

?>

<div style="background: white;">
<table style="margin: 0 auto;">
	<tr>
		<td style="font-size: 20px;">Логин:</td>
		<td style="font-size: 20px;"><?=$userParams['login']?></td>
	</tr>
	<tr>
		<td style="font-size: 20px;">Email:</td>
		<td style="font-size: 20px;"><?=$userParams['email']?></td>
	</tr>
	<tr>
		<td style="font-size: 20px;">ФИО:</td>
		<td style="font-size: 20px;"><?=$userParams['fio']?></td>
	</tr>
	<tr>
		<td style="font-size: 20px;">Phone:</td>
		<td style="font-size: 20px;"><?=$userParams['phone']?></td>
	</tr>
	<tr>
		<td style="font-size: 20px;">Активность:</td>
		<td style="font-size: 20px;"><?=$userParams['is_active'] ? 'Да' : 'Нет'?></td>
	</tr>
	<tr>
		<td style="font-size: 20px;">Получать уведомления:</td>
		<td style="font-size: 20px;"><?=$userParams['is_notifiable'] ? 'Да' : 'Нет'?></td>
	</tr>
	<tr>
		<td style="font-size: 20px; vertical-align: top;">Группы:</td>
		<td style="font-size: 20px;"><?php foreach ($groups as $groupName) { ?><?=$groupName?><br><?php } ?>
		</td>
	</tr>
</table>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>