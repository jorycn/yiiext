/******************************************************************************/
Ext.ns('sav');
/******************************************************************************/
/* Форма ввода новой темы                                                     */
/******************************************************************************/
// Вызывается в основном классе, показается в отдельном окне
sav.issueForm = Ext.extend(Ext.Window, {
//----------------------------------------------------------------------------//	
	id: 'issueForm',
	title: 'Новое обращение в поддержку',
	width: 640,
	height:480,
	minWidth: 320,
	minHeight: 240,
	layout: 'fit',
	plain:true,
	modal: true,
	closable: true,
//----------------------------------------------------------------------------//	
	// Строим форму
	form: function(){
		return new Ext.form.FormPanel({
			baseCls: 'x-plain',
			labelWidth: 70,
			defaultType: 'textfield',
			labelAlign:'right',
			buttonAlign: 'center',
			// Поля ввода
			items: [{
				fieldLabel: 'title',
				id: 'tfIssueSubject',
				anchor: '100%'
			}, {
				fieldLabel: 'messages',
				xtype: 'textarea',
				id: 'tfMessageText',
				anchor: '100% -0'
			}],
			// Кнопки управления
			buttons:[{
				id:'btnSaveIssue', 
				text: 'Отправить'		
			},
			{
				id:'btnCancelIssue', 
				text: 'Отмена'
			}]		
		})
	},
//----------------------------------------------------------------------------//
	// Конструктор
	initComponent: function(){
		this.items = [this.form()];
		sav.issueForm.superclass.initComponent.call(this);
	}
//----------------------------------------------------------------------------//	
});
/******************************************************************************/