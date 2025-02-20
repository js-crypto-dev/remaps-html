<div class="tab-pane @if($tab == 'finance') active @endif" id="financial-fill" role="tabpanel" aria-labelledby="financial-tab-fill">
  <form class="form" action="{{ route('company.setting.store') }}" method="POST">
    @csrf
    <input type="hidden" name="tab" value="finance" />
    <div class="row">
      <div class="col-md-4 col-12">
        <div class="mb-1">
          <label class="form-label" for="bank_account">Bank account <small class="text-muted">(optional)</small></label>
          <input
            type="text"
            id="bank_account"
            class="form-control"
            placeholder=""
            name="bank_account"
            value="{{ $company->bank_account }}" />
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="mb-1">
          <label class="form-label" for="bank_identification_code">Bank identification code (BIC) <small class="text-muted">(optional)</small></label>
          <input
            type="text"
            id="bank_identification_code"
            class="form-control"
            placeholder=""
            name="bank_identification_code"
            value="{{ $company->bank_identification_code }}" />
        </div>
      </div>
      <div class="col-md-4 col-12"></div>

      <div class="col-md-4 col-12">
        <div class="mb-1">
          <label class="form-label" for="vat_number">Vat number</label>
          <input
            type="text"
            id="vat_number"
            class="form-control"
            placeholder=""
            name="vat_number"
            value="{{ $company->vat_number }}" />
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="mb-1">
          <label class="form-label" for="vat_percentage">Vat percentage</label>
          <input
            type="text"
            id="vat_percentage"
            class="form-control"
            placeholder="%"
            name="vat_percentage"
            value="{{ $company->vat_percentage }}" />
        </div>
      </div>
    </div>
    <hr>
    <p>
      <strong>Note: </strong>
      To generate your API credientials log in with your Paypal Account at:
      <a href="https://developer.paypal.com/developer/applications">https://developer.paypal.com/developer/applications</a>.
      Click on : MY APPS AND CREDENTIALS, Scroll down to REST API apps and click CREATE APP.
    </p>
    <div class="row">
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="paypal_client_id">Paypal client id</label>
          <input
            type="text"
            id="paypal_client_id"
            class="form-control"
            placeholder=""
            name="paypal_client_id"
            value="{{ $company->paypal_client_id }}" />
        </div>
      </div>
      <div class="col-md-6 col-12"></div>
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="paypal_secret">Paypal secret</label>
          <input
            type="text"
            id="paypal_secret"
            class="form-control"
            placeholder=""
            name="paypal_secret"
            value="{{ $company->paypal_secret }}" />
        </div>
      </div>
      <div class="col-md-3 col-12">
        <div class="mb-1">
          <label class="form-label" for="paypal_currency_code">Paypal currency code</label>
            <select name="paypal_currency_code" class="form-select">
              @foreach (config('constants.currencies') as $code)
                <option value="{{ $code }}" @if ($company->paypal_currency_code == $code) selected @endif>{{ $code }}</option>
              @endforeach
            </select>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="stripe_key">Stripe key</label>
          <input
            type="text"
            id="stripe_key"
            class="form-control"
            placeholder=""
            name="stripe_key"
            value="{{ $company->stripe_key }}" />
        </div>
      </div>
      <div class="col-md-6 col-12"></div>
      <div class="col-md-6 col-12">
        <div class="mb-1">
          <label class="form-label" for="stripe_secret">Stripe secret</label>
          <input
            type="text"
            id="stripe_secret"
            class="form-control"
            placeholder=""
            name="stripe_secret"
            value="{{ $company->stripe_secret }}" />
        </div>
      </div>
    </div>
    <hr>
    <div class="col-12 mb-1">
        <div class="form-check form-check-inline my-1">
            <input type="hidden" name="is_bank_enabled" value="0" />
            <input class="form-check-input" type="checkbox" id="is_bank_enabled" name="is_bank_enabled" value="1" @if($company->is_bank_enabled) checked @endif/>
            <label class="form-check-label" for="is_bank_enabled">Activate Bank Transfer</label>
        </div>
        <div class="col-6" id="bi_area">
            <div class="mb-1">
                <label class="form-label" for="bank_info">Bank Information</label>
                <textarea
                    class="form-control"
                    id="bank_info"
                    rows="5"
                    placeholder=""
                    name="bank_info"
                    style="height: 500px;"
                >{{ $company->bank_info }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-12 mb-1">
        <div class="form-check form-check-inline my-1">
            <input type="hidden" name="is_invoice_pdf" value="0" />
            <input class="form-check-input" type="checkbox" id="is_invoice_pdf" name="is_invoice_pdf" value="1" @if($company->is_invoice_pdf) checked @endif/>
            <label class="form-check-label" for="is_invoice_pdf">Deactivates the normal system generated invoice PDF</label>
        </div>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary me-1">Submit</button>
    </div>
  </form>
</div>
