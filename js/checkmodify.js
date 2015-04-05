function Check()
{
		if (document.send.id.value == "")
		{
				window.alert('请输入用户名!');
				return false;
		}
		if (document.send.id.value.length < 3 )
		{
				window.alert('用户名长度必须大于3!');
				return false;
		}
		if (document.send.name.value == "")
		{
				window.alert('请输入姓名！');
				return false;
		}
		if (document.send.phone.value == "")
		{
				window.alert('请输入电话');
				return false;
		}
		if (document.send.email.value == "")
		{
				window.alert('请输入email！');
				return false;
		}
		if (document.send.email.value.indexOf("@") == -1)
		{
				window.alert('请输入有效的Email地址！');
				return false;
		}
		return true;
}
