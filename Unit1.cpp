//---------------------------------------------------------------------------

#include <vcl.h>
#pragma hdrstop
#include <sstream>
#include "mysql.h"
#include "Unit1.h"
#include "Unit2.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
TForm1 *Form1;
  bool DisableOtherFunctionCall = false;
  int n=8;
//---------------------------------------------------------------------------

__fastcall TForm1::TForm1(TComponent* Owner)
        : TForm(Owner)
{

}
//---------------------------------------------------------------------------

void __fastcall TForm1::Connect1Click(TObject *Sender)
{
  int CardAddr = 3 - (int(CheckBox1->Checked) + int(CheckBox2->Checked) * 2);
  int h = OpenDevice(CardAddr);
  switch (h) {
    case  0 :
    case  1 :
    case  2 :
    case  3 :
      Label1->Caption = "Card " + IntToStr(h) + " connected";
      break;
    case  -1 :
      Label1->Caption = "Card " + IntToStr(CardAddr) + " not found";
  }
}

//---------------------------------------------------------------------------

void __fastcall TForm1::SetAllDigital1Click(TObject *Sender)
{
  SetAllDigital();
  DisableOtherFunctionCall = true;
  for (int i=0;i<8;i++)
  {
    op[i]->Checked = true;
  }
  DisableOtherFunctionCall = false;
}
//---------------------------------------------------------------------------

void __fastcall TForm1::OutBoxClick(TObject *Sender)
{
    int k = 0;
    int n = 1;
    for (int i=0;i<8;i++)
    {
      if (op[i]->Checked == true)
      {
        k = k + n;
      }
      n = n * 2;
    }
    if (DisableOtherFunctionCall == false)
	  WriteAllDigital(k);
}
//---------------------------------------------------------------------------

void __fastcall TForm1::Timer1Timer(TObject *Sender)
{
	MYSQL *conn;
	mySQL = mysql_init(NULL);
	std::stringstream stringbuilder;
	conn=mysql_real_connect(mySQL, "192.168.65.118", "root", "root", "stationMeteo", 0, NULL, 0);


	  Timer1->Enabled = false;
	  long Data1;
	  long Data2;
	  ReadAllAnalog(&Data1, &Data2);
	  Data1 = Data1*0.35-30;  //convertis la tension en degres
	  Data2 = Data2*0.35-30;  //convertis la tension en degres

	  //date / heure actuelle basée sur le système actuel
	  time_t current = time(0);
	  // convertir en forme de chaîne
	  char* actuel = ctime(&current);
	  //std::string someString(actuel);


	  AD1->Position = Data1;
	  AD2->Position = Data2;
	  Label4->Caption = IntToStr((__int64)Data1);
	  Label5->Caption = IntToStr((__int64)Data2);


	  Timer1->Enabled = true;

	  if(conn==NULL)
	  {

	  }
		// si la connexion à la BDD c'est bien passée
		// envoie des coordonnées dans la BDD
	  else
	  {
		  stringbuilder << "INSERT INTO `temperature` (`valeur`,`date`) VALUES (" << Data2 << ", '"<< actuel <<"')";
		  mysql_query(mySQL, stringbuilder.str().c_str());
	  }
}

//---------------------------------------------------------------------------

