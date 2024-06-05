@props(['action'])
<div class="continue-google">
    <button type="button" class="btn w-100" id="metamask">
        <span class="google-icon">
            <img src="{{ asset($activeTemplateTrue . 'images/icons/metamask.svg') }}">
        </span> {{ __(ucfirst($action)) }} @lang('With Metamask')
    </button>
</div>

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            document.getElementById("metamask").addEventListener('click', async function() {

                metmaskBtnLoading(true);

                const MMSDK = new MetaMaskSDK.MetaMaskSDK()
                setTimeout(async () => {

                    const ethereum = MMSDK.getProvider();
                    const accounts = await ethereum.request({
                        method: 'eth_requestAccounts'
                    });

                    const acount = accounts[0];

                    const messageResp = await fetch(
                        "{{ route('user.web3.metamask.login.message') }}", {
                            method : "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                '_token'        : '{{ csrf_token() }}',
                                'wallet_address': acount
                            })
                        });

                    const message = await messageResp.json();
                    if (!message.success) {
                        metmaskBtnLoading();
                        notify('error', message.message);
                        return;
                    }
                    const signature = await ethereum.request({
                        method: 'personal_sign',
                        params: [message.message, acount],
                    });

                    const verifyRequest = await fetch(
                        "{{ route('user.web3.metamask.login.verify') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                '_token': '{{ csrf_token() }}',
                                'signature': signature
                            })
                        });

                    const verifyMessage = await verifyRequest.json();
                    if (!verifyMessage.success) {
                        metmaskBtnLoading();
                        notify('error', verifyMessage.message);
                        metmaskBtnLoading();
                        return;
                    }

                    metmaskBtnLoading();
                    notify('success', verifyMessage.message);

                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                }, 100)
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('#metamask')) return false;
                metmaskBtnLoading();
            });

            function metmaskBtnLoading(isShow = false) {
                const metamaskBtn = document.getElementById("metamask");
                if(isShow) {
                    metamaskBtn.innerHTML = `<div class="spinner-border text-primary" role="status"></div>`;
                    metamaskBtn.setAttribute('disabled', true);
                } else {
                    metamaskBtn.removeAttribute('disabled');
                    metamaskBtn.innerHTML = `<span class="google-icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/icons/metamask.svg') }}">
                    </span> {{ __(ucfirst($action)) }} @lang('With Metamask')`
                }
            }
        });
    </script>
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/metamask-sdk.js') }}"></script>
@endpush
