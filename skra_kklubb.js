function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
function error() {
	var name = document.getElementById("nafn").value;
	var mail = document.getElementById("mail").value;
	var address = document.getElementById("address").value;
	var pnumber = document.getElementById("pnumber").value;
	var kyn = document.getElementById("kyn").value;
	var error = document.getElementById("error");
	
	var villubod = "";
	var villaNafn = nameValidate(name);
	var villaPostur = mailValidate(mail);
	var villaHeimilisfang = addressValidate(address);
	var villaPostfang = pnumberValidate(pnumber);
	var villaKyn = kynValidate(kyn);
	
	document.getElementById("error").style.display="block";
	villubod = "<ul>" + villaNafn + villaPostur + villaHeimilisfang +
				villaPostfang + villaKyn + "</ul>";
	error.innerHTML = villubod;
}

function nameValidate(name)
{
	if(name == "" || name == null) 
	{
		document.getElementById("nafn").style.backgroundColor="pink";		
		document.getElementById("nafn").style.borderColor="red";
		return "<li>Þú verður að slá inn nafn!</li>";
	}
	else 
	{
		return "";
	}
}

function mailValidate(mail)
{
	var hasAt = 0;
	var hasDot = 0;
	if(mail == "" || mail == null) 
	{
		document.getElementById("mail").style.backgroundColor="pink";		
		document.getElementById("mail").style.borderColor="red";
		return "<li>Þú verður að slá inn netfang!</li>";
	}
	else 
	{
		for(var i = 0; i < mail.length; i++)
		{
			if(mail[i] == "@")
			{
				hasAt++;
			}
			if(mail[i] == ".")
			{
				hasDot++;
			}
		}
		
		if(hasAt > 0 && hasDot > 0)
		{
			return "";
		}
		else
		{
			document.getElementById("mail").style.backgroundColor="pink";		
			document.getElementById("mail").style.borderColor="red";
			return "<li>Það verður að vera @ og . í netfanginu</li>";
		}
	}
}
	
function addressValidate(address)
{
	var hasStaf = 0;
	var hasTala = 0;
	if(address == "" || address == null) 
	{
		document.getElementById("address").style.backgroundColor="pink";		
		document.getElementById("address").style.borderColor="red";
		return "<li>Þú verður að slá inn heimilisfang!</li>";
	}
	else 
	{
		for(var i = 0; i < address.length; i++)
		{
			if(address[i] === "[A-Za-z]")
			{
				hasStaf++;
			}
			if(address[i] === "[0-9]")
			{
				hasTala++;
			}
		}
		
		if(hasStaf > 0 && hasTala > 0)
		{
			return "";
		}
		else
		{
			document.getElementById("address").style.backgroundColor="pink";		
			document.getElementById("address").style.borderColor="red";
			return "<li>Það verður að vera stafur og tölustafur í heimilisfanginu</li>";
		}
	}
}

function pnumberValidate(pnumber)
{
	var post = document.getElementById("pnumber");
	var post2 = post.options[post.selectedIndex].value;
	
	if(post2 == "Default") 
	{
		document.getElementById("pnumber").style.backgroundColor="pink";		
		document.getElementById("pnumber").style.borderColor="red";
		return "<li>Þú verður að velja póstfang!</li>";
	}
	else 
	{
		return "";
	}
}

function kynValidate(kyn)
{
	var msex = document.getElementById("msex");
	var fsex = document.getElementById("fsex");
	var x = 0;
	
	if(msex.checked)
	{
		x++;
	}
	
	if(fsex.checked)
	{
		x++;
	}
	
	if(x == 0) 
	{
		document.getElementById("kyn").style.backgroundColor="pink";		
		document.getElementById("kyn").style.borderColor="red";
		return "<li>Þú verður að velja kyn!</li>";
	}
	else 
	{
		return "";
	}
}