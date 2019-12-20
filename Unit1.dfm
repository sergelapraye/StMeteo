object Form1: TForm1
  Left = 188
  Top = 102
  Caption = 'K8055 USB Experiment Interface Board'
  ClientHeight = 305
  ClientWidth = 603
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 290
    Top = 140
    Width = 15
    Height = 13
    Caption = '- - -'
  end
  object GroupBox1: TGroupBox
    Left = 152
    Top = 55
    Width = 105
    Height = 41
    Caption = 'Card Address'
    TabOrder = 0
    object CheckBox1: TCheckBox
      Left = 8
      Top = 16
      Width = 41
      Height = 17
      Caption = 'SK5'
      Checked = True
      State = cbChecked
      TabOrder = 0
    end
    object CheckBox2: TCheckBox
      Left = 56
      Top = 16
      Width = 41
      Height = 17
      Caption = 'SK6'
      Checked = True
      State = cbChecked
      TabOrder = 1
    end
  end
  object Connect1: TButton
    Left = 338
    Top = 65
    Width = 105
    Height = 29
    Caption = 'Connect'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -11
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
    TabOrder = 1
    OnClick = Connect1Click
  end
  object GroupBox4: TGroupBox
    Left = 32
    Top = 8
    Width = 49
    Height = 289
    Caption = 'AD1'
    TabOrder = 2
    object Label4: TLabel
      Left = 16
      Top = 272
      Width = 15
      Height = 13
      Caption = '00'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object AD1: TProgressBar
      Left = 16
      Top = 24
      Width = 17
      Height = 241
      Max = 255
      Orientation = pbVertical
      Smooth = True
      TabOrder = 0
    end
  end
  object GroupBox5: TGroupBox
    Left = 512
    Top = 8
    Width = 49
    Height = 289
    Caption = 'AD2'
    TabOrder = 3
    object Label5: TLabel
      Left = 16
      Top = 272
      Width = 15
      Height = 13
      Caption = '00'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object AD2: TProgressBar
      Left = 16
      Top = 25
      Width = 17
      Height = 241
      Max = 255
      Orientation = pbVertical
      Smooth = True
      TabOrder = 0
    end
  end
  object Timer1: TTimer
    Interval = 5000
    OnTimer = Timer1Timer
    Left = 284
    Top = 64
  end
end
