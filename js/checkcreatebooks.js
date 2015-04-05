function Check()
{
		if (document.send.isbn.value == "")
		{
				window.alert('请输入ISBN号!');
				return false;
		}
		if (document.send.name.value == "")
		{
				window.alert('请输入书名!');
				return false;
		}
		if (document.send.author.value == "")
		{
				window.alert('请输入作者!');
				return false;
		}
		if (document.send.press.value == "")
		{
				window.alert('请输入出版社!');
				return false;
		}
		if (document.send.publicationdate.value == "")
		{
				window.alert('请输入出版年!');
				return false;
		}
		if (document.send.price.value == "")
		{
				window.alert('请输入价格!');
				return false;
		}
		if (document.send.callnumber.value == "")
		{
				window.alert('请输入索书号!');
				return false;
		}
		return true;
}
