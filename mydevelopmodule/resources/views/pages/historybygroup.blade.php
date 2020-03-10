@extends('layouts.app')
@section('content')
<div class="container-fluid app-body">
	 <h2>Recent Post Sent To Buffer- Search By Group- <span style="color: green;">{{$squery}}</span></h2>
	    <form class="form-style form-style-2" method="GET" action="{{route('get.search')}}">
        <p>
            {{ csrf_field() }}
            <input type="text" name="search" style="width: 400px;"  placeholder="Search By Group Name" required="1">
            <i class="icon-search"></i>
            <button class="color button small publish-question1" value="submit">Search</button>
        </p>
    </form>

     <form action="{{route('get.searchbygroup')}}" method="GET">
      {{ csrf_field() }}
        <div class="form-group formgroup5 row">
              <div class="col-sm-8 colstyle5">
                 <select class="form-control" name="document_type" id="con1"">
                    <option value="">Search By Groups</option>
                 @foreach($groups as $gp)
                   
              <option value="{{ $gp->type }}">{{ $gp->type }}</option>
                 @endforeach
                    
                 </select>
                 <button class="color button small publish-question1" value="submit">Search</button>
              </div>
           </div>
     </form>

      <form action="{{route('get.searchbydate')}}" method="GET">
        <label>Search BY Date</label>
      {{ csrf_field() }}
       <p>
            {{ csrf_field() }}
            <input type="date" name="datesearch"  required="1">
            <i class="icon-search"></i>
            <button class="color button small publish-question1" value="submit">Search</button>
        </p>
     </form>
    <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                 <tr>
                  <th style="text-align: center;" width="10%">Group Name</th>
                  <th style="text-align: center;" width="20%">Group Type</th>
                  <th style="text-align: center;" width="20%">Account Name</th>
                  <th style="text-align: center;" width="20%">Post Text</th>
                  <th style="text-align: center;" width="15%">Time</th>
                
                </tr>
                </thead>
                <tbody>
            @if(count($bposts)>0)
              @foreach($bposts as $post)
              
                <tr>
                  <td> {{$post->name}}</td>
                  <td>{{$post->type}}</td>
                  
                   <td><img src="{{$post->avatar}}"  height="100" width="100"></td>
                  <td>{!! $post->post_text !!}</td>
                  <td>{{date('j M ,Y H:i A',strtotime($post->created_at))}}</td>
                  
                 
                </tr>
               @endforeach
              @else
               <td style="color: red; font-weight: bold;" colspan="5">OOps!! No Data, Try Again</td>
              @endif
                </tbody>             
              </table>

                 {{ $bposts->appends(request()->input())->links() }}
            </div>

</div>
@endsection
