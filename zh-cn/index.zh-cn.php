<?php // index.php
include_once 'rnheader.php';

echo("
<html>
    <body>
    <div id=\"body\">
    <div class=\"inner\">
      <h2>关于我们</h2>
<h4>FlightGuru 是一个利用群众外包与电脑演算法的机票搜寻网站。群众来源为世界各地的机票专家，机票专家以竞争的方式帮助顾客。</h4>
<h2>您的奖励是什么？</h2>
<h4>机票专家可以赚取高达$70美金/hr。每个得标的最佳机票建议将获得30美金以上的奖励. </h4>
<h2>想加入吗?</h2>
<h4>只要简单填写以下的栏位我们将尽快联络您</h4>
<br />");?>
<form method='post' action="send_form_email.php">

<table class="noborder">
<tr>
<td width=40%>
<LABEL for="from" value="your email">您的电子邮箱</LABEL>
<td width=40%>
<LABEL for="to">选择一个密码</LABEL>
<tr>
<td><input type="text" compulsory="yes" size="30" value="" id="from1" name="email" />
<td><input type="password" size="30" value="" id="to1" name="password" />
</table>
<br />
<LABEL for="depart">您最得意的一次飞行旅程规划</LABEL>
<br />
<textarea name='flight' cols='62' rows='5'></textarea><br /><br />
<input class="buttonn" type='submit' value='送出' />
</form>

</div>
	</div>
  </body>
</html>
<?php
include "footer.php"
?>
