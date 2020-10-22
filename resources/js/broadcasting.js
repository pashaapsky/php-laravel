Echo.channel('test-channel')
    .listen('ChannelEvent', (event) => {
        console.log(event);
        alert(event.data);
    });
