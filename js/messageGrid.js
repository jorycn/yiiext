/******************************************************************************/
Ext.ns('sav');
/******************************************************************************/
/* Форма ввода сообщения (внизу)                                                    */
/******************************************************************************/
sav.messageGrid = Ext.extend(Ext.grid.GridPanel, {
//----------------------------------------------------------------------------//	
	// Выделение целой строки
	//selModel: new Ext.grid.RowSelectionModel({ singleSelect:true}),
//----------------------------------------------------------------------------//	
	store: new Ext.data.Store({
		// Запросы отправляются при изменении строк автоматически
		//autoSave: false,
		id: 'messageStore',
//----------------------------------------------------------------------------//
		// Запросы PHP
		proxy: new Ext.data.HttpProxy({
			api:{				
				// Вставка нового сообщения, insert
				create: '/index.php/message/add',
				// Загрузка данных с сервера, load, reload, refresh
				read: {
					url:'/index.php/message/data', 
					method:'GET'
				}
			}
		}),
//----------------------------------------------------------------------------//
		// Подготовка данных для передачи на сервер
		writer: new Ext.data.JsonWriter({
			encode: true,
			writeAllFields: false,
			listful: false
		}),
//----------------------------------------------------------------------------//		
		// Читатель данных из PHP
		reader: new Ext.data.JsonReader({
			idProperty: 'msg_id',
			root:'Message',
			totalProperty:'total',
			successProperty: 'success'
		},
//----------------------------------------------------------------------------//
		// Список полей ридера
		[{
			name: 'issue_id',
			type: 'int',
			mapping: 'issue_id'
		},

		{
			name: 'issue_subject',
			type: 'string',
			mapping: 'issue_subject'
		},

		{
			name: 'issue_date',
			type: 'date',
			mapping: 'issue_date',
			dateFormat:'Y-m-d H:i:s'
		},

		{
			name: 'client_id',
			type: 'int',
			mapping: 'client_id'
		},

		{
			name: 'support_id',
			type: 'int',
			mapping: 'support_id'
		},

		{
			name: 'msg_id',
			type: 'int',
			mapping: 'msg_id'
		},

		{
			name: 'msg_text',
			type: 'string',
			mapping: 'msg_text'
		},

		{
			name: 'msg_date',
			type: 'date',
			mapping: 'msg_date',
			dateFormat:'Y-m-d H:i:s'
		},

		{
			name: 'user_id',
			type: 'int',
			mapping: 'user_id'
		},

		{
			name: 'user_login'
		},

		{
			name: 'user_name'
		},

		{
			name: 'client_login'
		},

		{
			name: 'client_name'
		},

		{
			name: 'support_login'
		},

		{
			name: 'support_name'
		}]),
		// Сортировка по дате последнего сообщения
		sortInfo:{
			field:'msg_date', 
			direction:'desc'
		}
	}),
//----------------------------------------------------------------------------//	
	// Структура колонок грида
	cm: new Ext.grid.ColumnModel(
		[{
			header: 'msg_id',
			dataIndex: 'msg_id'
		},
		
		{
			header: 'date',
			dataIndex: 'msg_date',
			renderer: sav.utils.dateRu
		},		

		{
			header: 'author',
			dataIndex: 'user_name'
		},
		
		{
			header: 'messages',
			height:'auto',
			width: 600,
			dataIndex: 'msg_text'
		}]),
//----------------------------------------------------------------------------//
	// Загрузка данных с сервера
	load: function(issue){
		// Определяем тему
		this.issueID = issue.get('issue_id');
		// Парамертр id темы для передачи на сервер
		this.store.setBaseParam('issue_id', this.issueID);
		// Заголовок грида сообщений, добавляется имя пользователя
		this.setTitle('message (№'+this.issueID+'-'+issue.get('issue_subject')+')');
		// Получание данных с сервера
		this.store.load();
	},
//----------------------------------------------------------------------------//	
	// Вставка сообщения
	insert: function(issue, msgText){
		// Определяем тему
		this.issueID = issue.get('issue_id')
		// title выбрана и она не закрыта
		if (this.issueID && !issue.get('is_closed')){
			// Формирование новой записи для вставки в БД
			var	rec = new this.store.recordType({
				msg_text: msgText,
				issue_id: this.issueID
			});
			// Вставка новой записи и отправлка на сервер
			this.store.insert(0, rec);
			// Обновление грида с сервера
			this.refresh();
		}
	},
//----------------------------------------------------------------------------//	
	// Обновление грида
	refresh: function(){
		if (this.issueID){
			// Передать параметры в запрос
			this.store.setBaseParam('issue_id', this.issueID);
			// Запросданных с сервера
			this.store.reload();
		}
	},	
//----------------------------------------------------------------------------//	
	// Конструктор
	initComponent : function() {
		//this.cm.defaultSortable = true;		
		// Автообнолвение грида сообщений через 5 сек.
		setInterval(this.refresh.bind(this), 5000);
		sav.messageGrid.superclass.initComponent.call(this);
	}	
//----------------------------------------------------------------------------//	
});