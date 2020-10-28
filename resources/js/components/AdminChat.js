import React from 'react';
import ReactDOM from 'react-dom';

class AdminChat extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            message : '',
        };
    }

    addMessage(data) {
        this.setState({
            message : this.state.message + data
        });
        const chat = document.querySelector('.admin-chat__message-block');
        chat.innerHTML = this.state.message;
    }

    componentDidMount() {
        Echo.private('admin-chat-channel')
            .listen('PostUpdatedAdminChat', (event) => {

                let time = new Date(event.post.updated_at).toTimeString();
                time = time.slice(0, time.indexOf(' '));

                let result = `<div class="message">
                                <time>${time}</time>
                                <p>Была изменена 
                                    <a class="message-link" href="/posts/${event.post.id}">статья #${event.post.id}</a>
                                </p>
                                
                                <p>${event.data}</p>
                              </div>`;

                this.addMessage(result);
            });
    }

    render()
    {
        return (
            <div className="container">
                <div className="admin-chat">
                    <div className="admin-chat__body collapse p-1 mb-1" id="adminChatCollapse" >
                        <h5 className="admin-chat_header text-center">Сообщения</h5>

                        <div className="admin-chat__message-block">

                        </div>
                    </div>

                    <a className="admin-chat-btn btn btn-primary"
                       data-toggle="collapse" href="#adminChatCollapse" role="button"
                       aria-expanded="false" aria-controls="adminChatCollapse">
                       Канал администраторов
                    </a>
                </div>
            </div>
        );
    }
}

export default AdminChat;

if (document.getElementById('admin-channel')) {
    ReactDOM.render(<AdminChat />, document.getElementById('admin-channel'));
}
