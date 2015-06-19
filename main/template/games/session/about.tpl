<div id="about-session">
{% for course_data in courses %}
    {% if courses|length > 1 %}
 <div class="row">
    <div class="col-xs-12">
        <h2 class="text-uppercase">{{ course_data.course.getTitle }}</h2>
    </div>
 </div>
    {% endif %}

    <div class="row">
        {% if course_data.video %}
            <div class="col-sm-6 col-md-7">
                <div class="embed-responsive embed-responsive-16by9">
                    {{ course_data.video }}
                </div>
            </div>
        {% endif %}

        <div class="{{ course_data.video ? 'col-sm-6 col-md-5' : 'col-sm-12' }}">
            <div class="description-course">
                {{ course_data.description.getContent }}
            </div>
            {% if course_data.tags %}
                <div class="tags-course">
                    <i class="fa fa-check-square-o"></i>
                       {% for tag in course_data.tags %}
                       <a href="#">{{ tag.getTag }}</a>
                       {% endfor %}
                </div>
            {% endif %}
                <div class="subscribe">
                    <a href="#" class="btn btn-success">{{ "Subscribe"|get_lang }}</a>
                </div>
        </div>
    </div>
    <div class="row info-course">
        <div class="col-xs-12 col-md-12">
            <h4 class="title-section">{{ "CourseInformation"|get_lang }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-7">

                <div class="panel-body">
                    {% if course_data.objectives %}
                    <div class="objective-course">
                        <h4 class="title-info"><i class="fa fa-square"></i> {{ "Objectives"|get_lang }}</h4>
                        <div class="content-info">
                            {{ course_data.objectives.getContent }}
                        </div>

                    </div>
                    {% endif %}
                    {% if course_data.topics %}
                    <div class="topics">
                        <h4 class="title-info"><i class="fa fa-square"></i> {{ "Topics"|get_lang }}</h4>
                        <div class="content-info">
                            {{ course_data.topics.getContent }}
                        </div>

                    </div>
                    {% endif %}
                </div>

        </div>

        <div class="col-xs-12 col-md-5">
            {% if course_data.coaches %}
            <div class="teachers">
                <div class="heading">
                    <h4>{{ "Coaches"|get_lang }}</h4>
                </div>
                <div class="panel-body">
                    {% for coach in course_data.coaches %}
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <h4>{{ coach.complete_name }}</h4>
                            {% if coach.officer_position %}
                            <p>{{ coach.officer_position }}</p>
                            {% endif %}

                            {% if coach.work_or_study_place %}
                            <p>{{ coach.work_or_study_place }}</p>
                            {% endif %}
                        </div>
                        <div class="col-xs-5 col-md-5">
                            <div class="text-center">
                                <img class="img-circle" src="{{ coach.image }}" alt="{{ coach.complete_name }}">
                            </div>
                        </div>
                    </div>
                    {% endfor %}
                </div>
            </div>
            {% endif %}
            <div class="social-share">
                <div class="heading"><h4>¡{{ "ShareWithYourFriends"|get_lang }}!</h4></div>
                <div class="panel-body">
                    <div class="icons-social text-center">
                        <a href="#" class="btn-social">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="btn-social">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="btn-social">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="subscribe text-center">
                <a href="#" class="btn btn-success btn-lg">{{ "Subscribe"|get_lang }}</a>
            </div>
        </div>
    </div>
{% endfor %}
</div>