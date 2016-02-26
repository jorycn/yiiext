/******************************************************************************/
Ext.BLANK_IMAGE_URL = '../extjs/resources/images/default/s.gif';
//----------------------------------------------------------------------------//
Ext.onReady(function(){
//----------------------------------------------------------------------------//
	Ext.QuickTips.init();
//----------------------------------------------------------------------------//
	Ext.ns('sav');
/******************************************************************************/
/* Основной клаcc приложения                                                  */
/******************************************************************************/
	sav.viewport = Ext.extend(Ext.Viewport, {
//----------------------------------------------------------------------------//		
		id:'supportViewport',
		title:'issue',
		layout:'border',
//----------------------------------------------------------------------------//
		// Грид "Темы", issueGrid.js
		issueGrid: new sav.issueGrid({
			id: 'issueGrid',
			title:'Issue (' + sav.TITLE + ')',
			region:'north',
			width:'80%',
			height:300,			
			split:true
		}),
//----------------------------------------------------------------------------//		
		// Форма для создания новых тем, issueForm.js
		issueForm: new sav.issueForm({}),
//----------------------------------------------------------------------------//		
		// Грид "message", messageGrid.js
		messageGrid: new sav.messageGrid({
			id: 'messageGrid',
			title:'message',
			region:'center',
			width:'80%'
		}),
//----------------------------------------------------------------------------//		
		// Форма для отправки сообщений, messageForm.js
		messageForm: new sav.messageForm({
			region:'south',
			width:'80%',
			height: 150
		}),		
//----------------------------------------------------------------------------//				
//	Events                                                                    //
//----------------------------------------------------------------------------//		
		// logout из поддержки, переход в корень сайта
		onExit: function(){
			location.href='/';
		},
//----------------------------------------------------------------------------//				
		// Зкрыть тему (может только роль 'User', хотя нужно подумать)
		onCloseIssue: function(){			
			var vp = Ext.getCmp('supportViewport');
			// Должна быть выбрана тема в onIssueSelect
			if (vp.issue){
				vp.issueGrid.close(vp.issue);
			}else{
				Ext.Msg.alert('Темы', 'Выберите тему!');				
			}
		},
//----------------------------------------------------------------------------//				
		// Старт формы создания новой темы
		// Сохранение в БД в событии onSaveIssue
		onAddIssue: function(){			
			form = Ext.getCmp('issueForm');
			form.show();
		},
//----------------------------------------------------------------------------//				
		// logout из формы создание темы
		onOpenIssue: function(){
			var vp = Ext.getCmp('supportViewport');
			// title долдны быть выбрана в onIssueSelect
			// Нельзя  открыть закрытую темы (можно подумать)
			if (vp.issue && !vp.issue.get('is_closed')){				
				vp.issueGrid.open(vp.issue);
			}else{
				// Алерты об ошибках
				if (!vp.issue){
					Ext.Msg.alert('Темы', 'Выберите тему!');					
				}
				if (vp.issue.get('is_closed')){
					Ext.Msg.alert('Темы', 'title закрыта!');
				}				
			}
		},			
//----------------------------------------------------------------------------//				
		// logout из формы создание темы
		onCancelIssue: function(){
			Ext.getCmp('issueForm').hide();
		},	
//----------------------------------------------------------------------------//				
		// Добавить новое обращение
		onSaveIssue: function(){
			// Вставка темы
			Ext.getCmp('issueGrid').insert(
				Ext.getCmp('tfIssueSubject').getValue(), 
				Ext.getCmp('tfMessageText').getValue());
			
			// Очистка формы ввода
			Ext.getCmp('tfIssueSubject').reset();
			Ext.getCmp('tfMessageText').reset();

			Ext.getCmp('issueForm').hide();
		},
//----------------------------------------------------------------------------//				
		// Master-Detail, выбор темы и обновление списка сообщений по теме
		onIssueSelect: function(grid, rowIndex, e){
			var vp = Ext.getCmp('supportViewport');
			// Сохранить в переменную выбранную тему для операций с выбраной 
			// темой
			vp.issue = grid.store.getAt(rowIndex);
			// Загрузка сообщений по выбранной теме
			Ext.getCmp('messageGrid').load(vp.issue);
		},
//----------------------------------------------------------------------------//				
		// Добавление нового сообщения к теме
		onAddMessage: function(obj, e){
			var issue = Ext.getCmp('supportViewport').issue;
		
			//  User можеть писать ответы в неоткрытые темы
			//	Support может писать только после открытия темы на себя
			//	В закрытые темы писать нельзя
			if (issue && !issue.get('is_closed') && 
				((issue.get('status_id') == 1 || issue.get('status_id') == 2) 
				&& sav.IS_USER || issue.get('status_id') == 2 && sav.IS_SUPPORT)
				){
				var newMessage = Ext.getCmp('tfAddMessage').getValue();
				// Пустое не вставляем
				if (newMessage.valueOf() != ''){
					// Вставка сообщения
					Ext.getCmp('messageGrid').insert(issue, newMessage); 
					// Очистка поля ввода
					Ext.getCmp('tfAddMessage').reset();
				}
				else{
					Ext.Msg.alert('message', 'Напишите сообщение!');
				}
			} else {
				// Алерты с ошибками
				if (!issue){
					Ext.Msg.alert('message', 'Выберите тему!');
				}
				
				if (issue.get('is_closed')){
					Ext.Msg.alert('message', 'title закрыта!');
				}				
				
				if (issue.get('status_id') == 1){
					Ext.Msg.alert('message', 'title не открыта!');
				}				
			}
		},
//----------------------------------------------------------------------------//		
		// Конструктор
		initComponent: function(){
			// Загрузка тем в грид
			this.issueGrid.load();
			// Собираем форму из частей
			this.items = [this.issueGrid, this.messageGrid, this.messageForm];
			
			// Подписка на события
			this.issueGrid.on('rowclick', this.onIssueSelect);
			Ext.getCmp('btnAddMessage').handler = this.onAddMessage;
			Ext.getCmp('btnExit').handler = this.onExit;
			
			// User может создавать и закрывать темы
			if (sav.IS_USER){
				Ext.getCmp('btnAddIssue').handler = this.onAddIssue;			
				Ext.getCmp('btnCloseIssue').handler = this.onCloseIssue;
			}
			
			// Support "подпичывается" на темы
			if (sav.IS_SUPPORT){
				Ext.getCmp('btnOpenIssue').handler = this.onOpenIssue;
			}			
			
			Ext.getCmp('btnSaveIssue').handler = this.onSaveIssue;
			Ext.getCmp('btnCancelIssue').handler = this.onCancelIssue;
			
			sav.viewport.superclass.initComponent.call(this);
		}		
//----------------------------------------------------------------------------//				
	});	
/******************************************************************************/
/* Точка входа                                                                */
/******************************************************************************/
	new sav.viewport().show();
/******************************************************************************/	
});
/******************************************************************************/