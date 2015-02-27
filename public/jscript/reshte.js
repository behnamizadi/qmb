function ldMenu(mySubject) {
var Indx=mySubject;
with (document.getElementById('study_field')) 
{
options.length=0;
if (Indx==0)
{
options[0]=new Option("انتخاب","");
}
if (Indx==2)
{
options[0]=new Option("انتخاب","");
options[1]=new Option("ریاضی و فنی","22");
options[2]=new Option("علوم تجربی","23");
options[3]=new Option("علوم انسانی","24");
options[4]=new Option("هنر","25");
options[5]=new Option("کاردانش","26");
options[6]=new Option("فنی و حرفه‌ای","27");
}
if (Indx==3 || Indx==4 || Indx==5 || Indx==6 || Indx==7)
{
options[0]=new Option("انتخاب","");
options[1]=new Option("فناوری اطلاعات","1");
options[2]=new Option("کامپیوتر","2");
options[3]=new Option("برق","3");
options[4]=new Option("عمران","4");
options[5]=new Option("صنایع","5");
options[6]=new Option("مکانیک","6");
options[7]=new Option("مدیریت","7");
options[8]=new Option("اقتصاد","8");
options[9]=new Option("حسابداری","9");
options[10]=new Option("ریاضی","10");
options[11]=new Option("شیمی","11");
options[12]=new Option("فیزیک","12");
options[13]=new Option("معماری","13");
options[14]=new Option("آمار","14");
options[15]=new Option("زبان و ادبیات فارسی","15");
options[16]=new Option("الهیات و معارف اسلامی","16");
options[17]=new Option("حقوق","17");
options[18]=new Option("فلسفه","18");
options[19]=new Option("روانشناسی","19");
options[20]=new Option("کتابداری","20");
options[21]=new Option("زبان انگلیسی","21");
}
document.getElementById('study_field').options[0].selected=true;
}

}