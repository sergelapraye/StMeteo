//---------------------------------------------------------------------------

#ifndef Unit1H
#define Unit1H
//---------------------------------------------------------------------------
#include <Classes.hpp>
#include <Controls.hpp>
#include <StdCtrls.hpp>
#include <Forms.hpp>
#include <ComCtrls.hpp>
#include <Buttons.hpp>
#include <ExtCtrls.hpp>
#include "include/mysql.h"
//---------------------------------------------------------------------------
class TForm1 : public TForm
{
	__published:	// IDE-managed Components
			TGroupBox *GroupBox1;
			TCheckBox *CheckBox1;
			TCheckBox *CheckBox2;
			TButton *Connect1;
			TLabel *Label1;
			TGroupBox *GroupBox4;
			TLabel *Label4;
			TProgressBar *AD1;
			TGroupBox *GroupBox5;
			TLabel *Label5;
			TProgressBar *AD2;
			TTimer *Timer1;
			void __fastcall Connect1Click(TObject *Sender);
			void __fastcall SetAllDigital1Click(TObject *Sender);
			void __fastcall OutBoxClick(TObject *Sender);
			void __fastcall Timer1Timer(TObject *Sender);
	private:	// User declarations
			  TCheckBox* op[8];
			  TCheckBox* ip[5];
			  MYSQL *mySQL;
	public:		// User declarations
			__fastcall TForm1(TComponent* Owner);
};
//---------------------------------------------------------------------------
extern PACKAGE TForm1 *Form1;
//---------------------------------------------------------------------------
#endif

