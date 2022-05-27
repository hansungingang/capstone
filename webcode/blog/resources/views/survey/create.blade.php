@extends('layouts.app')

@section('script')
    <script>
        $(document).ready(function(){
            $('#question1').change(function(){
                var value = $(this).children(":selected").attr("value");
                if(value == "N"){
                    $('#question1_reason_div').show();
                }else{
                    $('#question1_reason_div').hide();
                }
            });

            $('#question2').change(function(){
                var value = $(this).children(":selected").attr("value");
                if(value == "Y"){
                    $('#question2_reason_div').show();
                    $('#question2_reason_div_write').show();
                }else{
                    $('#question2_reason_div').hide();
                    $('#question2_reason_div_write').hide();
                }
            });

            var msg = '{{ Session::get('alert')}}';
            var exist = '{{ Session::has('alert')}}';

            if(exist){
                alert(msg);
            }
        });
    </script>
@endsection

@section('content')
{!! Form::open([
    'route' => 'survey.store'
]) !!}
    @include('survey.form')
    <button type="submit" class="btn btn-primary btn-default ">저장</button>
{!! Form::close() !!}
@stop