
<ul class="nav navbar-nav">
              <li><a href="{{url('/')}}">Home</a></li>
              @foreach($categories as $category)
              
              <li><a href="{{url('category/'.$category['id'])}}">{{$category['category_name']}}<span class="caret"></span></a>
              @if(isset($sub_category[$category['id']][0]))
              <ul class="dropdown-menu">    
             
              @foreach($sub_category[$category['id']] as $sub)
           
                  <li><a href="{{url('sub_category/'.$sub['id'])}}">{{$sub['category_name']}}</a></li>
             @endforeach
     
 
                  </li>
                </ul>
                @endif
            
           
              </li>
              @endforeach
              @if(session()->has('FRONT_USER_LOGIN')!='0' && session()->has('FRONT_USER_ID')!='0')
              <li><a href="{{url('/')}}">{{session('FRONT_USER_NAME')}}</a>
                   <ul class="dropdown-menu">  
                   <li><a href="{{url('/pastOrder')}}">Past Order</a></li>
                   <li><a href="{{url('/remdemPoint')}}">Reedom Point</a></li>
                   </ul>
              </li>
              @endif
                </ul>
          
  
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
