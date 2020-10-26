import React from 'react';
import ReactDOM from 'react-dom';

class Example extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            hasUpdate: false
        };
    }

    componentDidMount() {
        Echo.private('admin')
            .listen('event', (event) => {
                console.log(event);
            });
    }

    reload() {
        window.location.reload();
    }

    render()
    {
        if (this.state.hasUpdate) {
            return (
                <div className="container">
                    <div className="row justify-content-center">
                        <div className="col-md-8">
                            <div className="card">
                                <div className="card-header">Example Component Show</div>
                                <button className="btn btn-primary"
                                        onClick={ () => {
                                            this.reload();
                                        }}
                                >
                                    Обновить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            );
        }
    }
}

export default Example;

if (document.getElementById('admin-channel')) {
    ReactDOM.render(<Example />, document.getElementById('admin-channel'));
}
