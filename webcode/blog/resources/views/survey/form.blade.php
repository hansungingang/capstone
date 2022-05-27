<div class="input-group mb-3">
    <div class="input-group-prepend w-70">
      <span class="input-group-text" id="basic-addon1">1. 경매방식(최고가 방식, 낙찰가 방식)은<br/> 부동산 매매에 적합하다고 생각하시나요?</span>
    </div>
    <select class="form-select" aria-label="Default select example" id="question1" name="question1">
        <option selected value="">선택</option>
        <option value="Y">네</option>
        <option value="N">아니요</option>
    </select>
</div>
<p>
    * 최고가 방식 : 경매 종료일 전에 최고가를 적은 경매 참가자가 경매에서 승리하는 방식입니다.
</p>
<p>
    * 낙찰가 방식 : 경매 참여자가 낙찰가이상으로 적으면 바로 경매가 끝나는 방식입니다. 
                   낙찰가 이상으로 적은 사람이 없다면 경매 종료일에 최고가의 경매 참여자가 경매에서 승리합니다.
</p>
<div>
    @if($errors->has('question1'))
        @foreach($errors->get('question1') as $error)
            {{ $error }}
        @endforeach
    @endif
</div>

<div class="input-group mb-3" style="display: none" id="question1_reason_div">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">1번에 대한 이유</span>
    </div>
    <input type="text" name="question1_reason" id="question1_reason" class="w-25 p-1" placeholder="이유" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('question1_reason') }}">
</div>
<div>
    @if($errors->has('question1_reason'))
        @foreach($errors->get('question1_reason') as $error)
            {{ $error }}
        @endforeach
    @endif
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">2. 해당 플랫폼을 사용하실 계획이 있으신가요?</span>
    </div>
    <select class="form-select" aria-label="Default select example" id="question2" name="question2">
        <option selected value="">선택</option>
        <option value="Y">네</option>
        <option value="N">아니요</option>
    </select>
</div>
<div>
    @if($errors->has('question2'))
        @foreach($errors->get('question2') as $error)
            {{ $error }}
        @endforeach
    @endif
</div>

<div class="input-group mb-3" style="display: none" id="question2_reason_div">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">전화번호 혹은 이메일을 알려주세요.</span>
    </div>
    <input type="text" name="question2_reason" id="question2_reason" class="w-50 p-1" placeholder="전화번호는 -없이 넣어주세요." aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('question2_reason') }}">
</div>
<div style="display: none" id="question2_reason_div_write">
    <p> &nbsp; * 설문 조사 목적으로만 개인정보를 사용할 예정입니다.</p>
</div>
<div>
    @if($errors->has('question1_reason'))
        @foreach($errors->get('question1_reason') as $error)
            {{ $error }}
        @endforeach
    @endif
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">3. 해당 플랫폼을 후원기부해주세요.</span>
      
    </div> 
</div>