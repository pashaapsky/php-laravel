import React from 'react';
import ReactDOM from 'react-dom';

class AdminChat extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            postUpdateMessage : '',
        };
    }

    componentDidMount() {
        Echo.private('admin-chat-channel')
            .listen('PostUpdated', (data) => {
                console.log(data);
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
                            {this.state.postUpdateMessage}
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
