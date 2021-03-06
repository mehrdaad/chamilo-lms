<?php
/* For licensing terms, see /license.txt */

/**
 * Class ch_percentage
 */
class ch_percentage extends survey_question
{
    /**
     * @param FormValidator $form
     * @param array $questionData
     * @param array $answers
     */
    public function render(FormValidator $form, $questionData = array(), $answers = '')
    {
        $options = array(
            '--' => '--'
        );

        foreach ($questionData['options'] as $key => & $value) {
            $options[$key] = $value;
        }

        $name = 'question'.$questionData['question_id'];

        $form->addSelect(
            $name,
            null,
            $options
        );

        if (!empty($answers)) {
            $form->setDefaults([$name => $answers]);
        }
    }
}


