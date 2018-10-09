<div id="contact-{{@user->id}}" class="tab-pane">
    <div class="row m-b-lg">
        <div class="col-lg-4 text-center">
            <h2>{{@user->label_name()}}</h2>

            <div class="m-b-sm">
                <img alt="image" class="img-circle" src="{{@BASE}}/img/a2.jpg"
                     style="width: 62px">
            </div>
        </div>
        <div class="col-lg-8">
            <strong>
                About me
            </strong>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <button type="button" class="btn btn-primary btn-sm btn-block"><i
                        class="fa fa-envelope"></i> Send Message
            </button>
        </div>
    </div>
    <div class="client-detail">
        <div class="full-height-scroll">
            <form role="form" class="form-ajax" action="{{@BASE}}/ajax/user_details_form/{{@user->id}}">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter name" class="form-control" value="{{@user->name}}" >
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" id="surname" name="surname" placeholder="Enter surname" class="form-control" value="{{@user->surname}}" >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter email" class="form-control" value="{{@user->email}}" >
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter phone" class="form-control" value="{{@user->phone}}" >
                </div>
                <div class="form-group">
                    <label>Roles</label>
                    <loop from="{{ @roles_list->first() }}" to="{{ !@roles_list->dry() }}" step="{{ @roles_list->next() }}">
                        <div class="i-checks"><label> <input type="checkbox" name="roles[{{@roles_list->name}}]" id="roles_{{@roles_list->name}}"> <i></i> {{@roles_list->label}} </label></div>
                    </loop>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="submit">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>